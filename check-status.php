<?php
session_start();
$page_title = "Check Application Status | PrimePath HR";
include 'includes/header.php';
require_once 'includes/helpers.php';

$lookup_query = '';
$lookup_result = null;
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // CSRF Check
    verify_csrf_token();

    $lookup_query = trim($_POST['lookup_query'] ?? '');
    $sanitized_query = htmlspecialchars(strip_tags($lookup_query));

    if (empty($sanitized_query)) {
        $error_message = 'Please enter your registered email address or phone number.';
    } else {
        // Search in registrations.json
        $reg_file = get_data_file_path('registrations.json');
        $found_apps = [];

        if (file_exists($reg_file)) {
            $regs_data = json_decode(file_get_contents($reg_file), true);
            if (is_array($regs_data)) {
                foreach ($regs_data as $reg) {
                    $email = strtolower($reg['email'] ?? '');
                    $phone = $reg['phone'] ?? '';
                    $query_lower = strtolower($sanitized_query);

                    if ($email === $query_lower || $phone === $sanitized_query || strpos($email, $query_lower) !== false) {
                        $found_apps[] = $reg;
                    }
                }
            }
        }

        $lookup_result = $found_apps;
    }
}
?>

<!-- Page Header -->
<section class="page-header"
    style="background: linear-gradient(135deg, var(--primary-navy) 0%, var(--secondary-blue) 100%); padding: 110px 0 70px; text-align: center; color: white;">
    <div class="container">
        <span style="display: inline-block; background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.25); padding: 6px 16px; border-radius: 20px; font-size: 13px; font-weight: 600; margin-bottom: 15px;">
            <i class="fas fa-user-check" style="margin-right: 6px;"></i> Candidate Portal
        </span>
        <h1 style="font-size: 40px; margin-bottom: 12px; text-shadow: 0 2px 10px rgba(0,0,0,0.2);">Check Application Status</h1>
        <p style="font-size: 17px; opacity: 0.9; max-width: 600px; margin: 0 auto;">Track the real-time progression of your executive application, assessment review, and compliance verification.</p>
    </div>
</section>

<!-- Lookup Form & Results -->
<section class="section section-bg-white" style="padding: 80px 0 110px;">
    <div class="container" style="max-width: 780px;">
        <div style="background: white; border-radius: 20px; padding: 45px; box-shadow: 0 12px 40px rgba(10, 25, 47, 0.08); border: 1px solid rgba(0,0,0,0.06);">
            <h2 style="font-size: 24px; color: var(--primary-navy); margin-bottom: 10px;">Application Lookup</h2>
            <p style="color: var(--text-muted); font-size: 15px; margin-bottom: 30px;">Enter the email address or phone number you used when submitting your candidacy or application.</p>

            <?php if (!empty($error_message)): ?>
                <div style="background: #FEE2E2; border-left: 4px solid #EF4444; color: #991B1B; padding: 14px 18px; border-radius: 6px; margin-bottom: 25px; font-size: 14px;">
                    <i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i> <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <form action="check-status.php" method="POST" style="display: flex; gap: 14px; flex-wrap: wrap;">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                <div style="flex: 1; min-width: 260px;">
                    <input type="text" name="lookup_query" value="<?php echo htmlspecialchars($lookup_query); ?>"
                        placeholder="e.g. john.doe@example.com or +971501234567"
                        style="width: 100%; padding: 15px 18px; border: 1.5px solid rgba(10, 25, 47, 0.15); border-radius: 10px; font-size: 15px; outline: none; transition: border-color 0.2s;" required>
                </div>
                <button type="submit" class="btn btn-primary"
                    style="background: linear-gradient(135deg, var(--secondary-blue) 0%, #007A99 100%); padding: 15px 32px; border-radius: 10px; font-weight: 600; font-size: 15px; border: none; cursor: pointer; color: white;">
                    <i class="fas fa-search" style="margin-right: 8px;"></i> Check Status
                </button>
            </form>

            <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($error_message)): ?>
                <div style="margin-top: 45px; border-top: 1px solid rgba(0,0,0,0.08); padding-top: 35px;">
                    <?php if (!empty($lookup_result)): ?>
                        <h3 style="font-size: 20px; color: var(--primary-navy); margin-bottom: 20px;">
                            Found <?php echo count($lookup_result); ?> Application(s) for "<?php echo htmlspecialchars($lookup_query); ?>"
                        </h3>
                        <div style="display: flex; flex-direction: column; gap: 20px;">
                            <?php foreach ($lookup_result as $app): ?>
                                <div style="border: 1px solid rgba(0,180,216,0.25); background: rgba(0,180,216,0.03); border-radius: 14px; padding: 24px;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; margin-bottom: 16px;">
                                        <div>
                                            <h4 style="font-size: 18px; color: var(--primary-navy); margin: 0;">
                                                <?php echo htmlspecialchars($app['name'] ?? 'Candidate Application'); ?>
                                            </h4>
                                            <span style="font-size: 13px; color: var(--text-muted);">
                                                Submitted on: <?php echo htmlspecialchars($app['date'] ?? 'Recent'); ?>
                                            </span>
                                        </div>
                                        <span style="background: #D1FAE5; color: #065F46; font-weight: 700; font-size: 12px; padding: 6px 14px; border-radius: 20px;">
                                            <i class="fas fa-check-circle" style="margin-right: 4px;"></i> Under Executive Review
                                        </span>
                                    </div>
                                    <!-- Status Pipeline Tracker -->
                                    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; margin-top: 20px;">
                                        <div style="text-align: center; padding: 12px; background: white; border-radius: 8px; border: 1px solid rgba(16,185,129,0.4);">
                                            <i class="fas fa-file-alt" style="color: #10B981; font-size: 18px; margin-bottom: 6px;"></i>
                                            <div style="font-size: 12px; font-weight: 700; color: #065F46;">1. Received</div>
                                        </div>
                                        <div style="text-align: center; padding: 12px; background: white; border-radius: 8px; border: 1px solid rgba(0,180,216,0.4);">
                                            <i class="fas fa-user-check" style="color: var(--secondary-blue); font-size: 18px; margin-bottom: 6px;"></i>
                                            <div style="font-size: 12px; font-weight: 700; color: var(--primary-navy);">2. Shortlisting</div>
                                        </div>
                                        <div style="text-align: center; padding: 12px; background: rgba(0,0,0,0.02); border-radius: 8px; opacity: 0.6;">
                                            <i class="fas fa-briefcase" style="color: var(--text-muted); font-size: 18px; margin-bottom: 6px;"></i>
                                            <div style="font-size: 12px; font-weight: 600;">3. Client Interview</div>
                                        </div>
                                        <div style="text-align: center; padding: 12px; background: rgba(0,0,0,0.02); border-radius: 8px; opacity: 0.6;">
                                            <i class="fas fa-plane-departure" style="color: var(--text-muted); font-size: 18px; margin-bottom: 6px;"></i>
                                            <div style="font-size: 12px; font-weight: 600;">4. Mobilization</div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div style="background: #FEF3C7; border-left: 4px solid #F59E0B; padding: 20px; border-radius: 8px; color: #92400E;">
                            <h4 style="margin: 0 0 8px; font-size: 16px;"><i class="fas fa-info-circle" style="margin-right: 8px;"></i> No Application Found</h4>
                            <p style="margin: 0; font-size: 14px; line-height: 1.6;">
                                We could not find an application associated with <strong><?php echo htmlspecialchars($lookup_query); ?></strong>. If you recently submitted your CV via email or LinkedIn, please allow up to 24 hours for our system to index your application.
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

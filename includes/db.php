<?php
// Database Helper for Jobs (Flat JSON File for cPanel deployment)

define('DATA_FILE', __DIR__ . '/../data/jobs.json');

function get_jobs() {
    if (!file_exists(DATA_FILE)) {
        return [];
    }
    $json = file_get_contents(DATA_FILE);
    $jobs = json_decode($json, true);
    return is_array($jobs) ? $jobs : [];
}

function get_job_by_id($id) {
    $jobs = get_jobs();
    foreach ($jobs as $job) {
        if ($job['id'] == $id) {
            return $job;
        }
    }
    return null;
}

function save_jobs($jobs) {
    return file_put_contents(DATA_FILE, json_encode($jobs, JSON_PRETTY_PRINT));
}

function add_job($data) {
    $jobs = get_jobs();
    $new_id = 1;
    if (count($jobs) > 0) {
        $max = 0;
        foreach ($jobs as $j) {
            if ($j['id'] > $max) $max = $j['id'];
        }
        $new_id = $max + 1;
    }
    $data['id'] = $new_id;
    $jobs[] = $data;
    return save_jobs($jobs);
}

function delete_job($id) {
    $jobs = get_jobs();
    $updated = [];
    foreach ($jobs as $job) {
        if ($job['id'] != $id) {
            $updated[] = $job;
        }
    }
    return save_jobs($updated);
}
?>

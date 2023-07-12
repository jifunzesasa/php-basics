<?php

namespace Gh;

class GhCli
{

    public static function seedLabels()
    {
        $labels = [
            "Priority: Critical" => "This should be dealt with ASAP.",
            "Priority: High" => "After critical issues are fixed, these should be dealt with before any issues.",
            "Priority: Medium" => "This issue may be useful, and needs some attention.",
            "Priority: Low" => "This issue can probably be picked up by anyone looking to contribute to the project.",
            "Type: Bug" => "Inconsistencies or issues which will cause an problems for users or implementors.",
            "Type: Maintenance" => "Updating phrasing or wording to make things clearer, without changing the functionality.",
            "Type: Enhancement" => "Most issues will probably ask for additions or changes.To be Pull Request.",
            "Type: Question" => "A query or seeking clarification on parts of the spec.",
            "Status: Available" => "No one has claimed responsibility for resolving this issue.",
            "Status: Accepted" => "It's clear what the subject of the issue is about, and what the resolution should be.",
            "Status: Blocked" => "There is another issue that needs to be resolved first, ",
            "Status: Completed" => "Nothing further to be done with this issue. ",
            "Status: In Progress" => "This issue is being worked on, and has someone assigned.",
            "Status: On Hold" => "Similar to blocked, but is assigned to someone.",
            "Status: Review Needed" => "The issue has a PR attached to it which needs to be reviewed.",
            "Status: Revision Needed" => "At least two people have seen issues in the PR that makes them uneasy.",
            "Status: Abandoned" => "It's believed that this issue is no longer important.",
            "Design Request" => "This issue requires a design to be created before it can be implemented.",
            "Bug Report" => "Something isn't working",
            "Idea" => "A new feature or improvement",
            "Feature" => "New feature or request",
            "Design Edit" => "A design needs to be updated or change to reflect a change in the spec",
            "Duplicate" => "This issue or pull request already exists",
            "Help wanted" => "Extra attention is needed",
            "Invalid" => "This doesn't seem right",
            "Wontfix" => "This will not be worked on",
        ];

        foreach ($labels as $label => $description) {
            shell_exec("gh label create \"$label\" --description \"$description\"");
            echo ".";
        }
    }

    public static function deleteAllLabel()
    {
        $labels = json_decode(shell_exec('gh label list --sort name --json name'));

        foreach ($labels as $label) {
            shell_exec('gh label delete "' . $label->name . '" --confirm');
        }
    }
}


// Usage:
// php gh_init.php seedLabels
// php gh_init.php deleteAllLabel
// php gh_init.php bumpTagViaSemver v1.0.0 major
// php gh_init.php bumpTagViaSemver v1.0.0 minor

// if cli
if (php_sapi_name() == "cli") {
    // if no arguments
    if (count($argv) < 2) {
        echo "Usage: php gh_init.php <method> <param1> <param2>\n";
        exit(1);
    }

    // if method doesn't exist
    if (!class_exists('Gh\GhCli') || !method_exists('Gh\GhCli', $argv[1])) {
        echo "Method doesn't exist\n";
        exit(1);
    }

    // if method exists
    $method = $argv[1]; // seedLabels
    $param1 = $argv[2]; // v1.0.0
    $param2 = $argv[3]; // major

    // call method
    GhCli::$method($param1, $param2);

    // exit
    exit(0);
}
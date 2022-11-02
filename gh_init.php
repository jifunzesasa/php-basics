<?php

function seedLabels()
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

function deleteAllLabel()
{
    $labels = json_decode(shell_exec('gh label list --sort name --json name'));

    foreach ($labels as $label) {
        shell_exec('gh label delete "' . $label->name . '" --confirm');
    }
}

/**
 * @param string $tag
 * @param string $release The release version to create, MAJOR.MINOR.PATCH
 */
function bumpTagViaSemver($tag, $release): string
{
    // is valid tag
    if (!preg_match('/^v\d+\.\d+\.\d+$/', $tag)) {
        throw new \Exception('Invalid tag format');
    }

    if ($release === 'major') {
        $tag = explode('.', $tag);
        $tag[0] = $tag[0] + 1;
        $tag[1] = 0;
        $tag[2] = 0;
        $tag = implode('.', $tag);
    }

    if ($release === 'minor') {
        $tag = explode('.', $tag);
        $tag[1] = $tag[1] + 1;
        $tag[2] = 0;
        $tag = implode('.', $tag);
    }
    if ($release === 'patch') {
        $tag = explode('.', $tag);
        $tag[2] = $tag[2] + 1;
        $tag = implode('.', $tag);
    }
    if ($release === 'experimental') {
        $tag = explode('.', $tag);
        $tag[2] = $tag[2] + 1;
        $tag = implode('.', $tag);
        $tag = $tag . '-experimental';
    }

    return $tag;
}


function getComposerVersionTag(): string
{
    $tag = '0.0.0';
    try {
        $composer = json_decode(file_get_contents('composer.json'), true);
        if (!is_null($composer['version'])) {
            return $composer['version'];
        }
    } catch (Exception $e) {
    }
    return $tag;
}


function updateComposerTag($tag)
{
    $composer = json_decode(file_get_contents('composer.json'));
    $composer->version = $tag;
    file_put_contents('composer.json', json_encode($composer, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}

function createRelease($releaseType, $pre = false, null|string $tag = null)
{
    $_tag =  ($tag === null) ? getComposerVersionTag() : $tag;
    $tag = bumpTagViaSemver($_tag, $releaseType);
    $pre = $pre ? ' --prerelease' : '';

    if ($releaseType !== 'experimental') {
        updateComposerTag($tag);
    }

    shell_exec('git add composer.json');
    shell_exec('git commit -m "Bump app version to ' . $tag . '"');

    try {
        shell_exec("gh release create $tag --generate-notes $pre");;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}


// createRelease('experimental', true, 'v0.0.1');

// $tag = bumpTagViaSemver('v0.0.1', 'experimental');
// updateComposerTag($tag);
echo "" . PHP_EOL;
echo "" . PHP_EOL;
echo 'CV: ' . bumpTagViaSemver(getComposerVersionTag(),'minor') . PHP_EOL;
echo "" . PHP_EOL;

<?php

use OpenAI\Responses\Skills\Versions\SkillVersionDeleteResponse;

test('from', function () {
    $result = SkillVersionDeleteResponse::from(skillVersionDeleteResource(), meta());

    expect($result)
        ->id->toBe('skillver_abc123')
        ->object->toBe('skill.version.deleted')
        ->deleted->toBeTrue()
        ->version->toBe('1');
});

test('as array accessible', function () {
    $result = SkillVersionDeleteResponse::from(skillVersionDeleteResource(), meta());

    expect($result['version'])
        ->toBe('1');
});

test('to array', function () {
    $result = SkillVersionDeleteResponse::from(skillVersionDeleteResource(), meta());

    expect($result->toArray())
        ->toBe(skillVersionDeleteResource());
});

test('fake', function () {
    $response = SkillVersionDeleteResponse::fake();

    expect($response)
        ->toBeInstanceOf(SkillVersionDeleteResponse::class);
});

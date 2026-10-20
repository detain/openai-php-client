<?php

use OpenAI\Responses\Skills\SkillResponse;

test('from', function () {
    $result = SkillResponse::from(skillResource(), meta());

    expect($result)
        ->id->toBe('skill_abc123')
        ->object->toBe('skill')
        ->createdAt->toBe(1710000000)
        ->name->toBe('basic-math')
        ->description->toBe('Add or multiply numbers.')
        ->defaultVersion->toBe('1')
        ->latestVersion->toBe('2');
});

test('as array accessible', function () {
    $result = SkillResponse::from(skillResource(), meta());

    expect($result['default_version'])
        ->toBe('1');
});

test('to array', function () {
    $result = SkillResponse::from(skillResource(), meta());

    expect($result->toArray())
        ->toBe(skillResource());
});

test('fake', function () {
    $response = SkillResponse::fake();

    expect($response)
        ->toBeInstanceOf(SkillResponse::class);
});

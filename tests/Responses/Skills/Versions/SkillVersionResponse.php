<?php

use OpenAI\Responses\Skills\Versions\SkillVersionResponse;

test('from', function () {
    $result = SkillVersionResponse::from(skillVersionResource(), meta());

    expect($result)
        ->id->toBe('skillver_abc123')
        ->object->toBe('skill.version')
        ->createdAt->toBe(1710000000)
        ->skillId->toBe('skill_abc123')
        ->version->toBe('1')
        ->name->toBe('basic-math')
        ->description->toBe('Add or multiply numbers.');
});

test('as array accessible', function () {
    $result = SkillVersionResponse::from(skillVersionResource(), meta());

    expect($result['skill_id'])
        ->toBe('skill_abc123');
});

test('to array', function () {
    $result = SkillVersionResponse::from(skillVersionResource(), meta());

    expect($result->toArray())
        ->toBe(skillVersionResource());
});

test('fake', function () {
    $response = SkillVersionResponse::fake();

    expect($response)
        ->toBeInstanceOf(SkillVersionResponse::class);
});

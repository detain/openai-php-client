<?php

use OpenAI\Responses\Skills\SkillDeleteResponse;

test('from', function () {
    $result = SkillDeleteResponse::from(skillDeleteResource(), meta());

    expect($result)
        ->id->toBe('skill_abc123')
        ->object->toBe('skill.deleted')
        ->deleted->toBeTrue();
});

test('as array accessible', function () {
    $result = SkillDeleteResponse::from(skillDeleteResource(), meta());

    expect($result['deleted'])
        ->toBe(true);
});

test('to array', function () {
    $result = SkillDeleteResponse::from(skillDeleteResource(), meta());

    expect($result->toArray())
        ->toBe(skillDeleteResource());
});

test('fake', function () {
    $response = SkillDeleteResponse::fake();

    expect($response)
        ->toBeInstanceOf(SkillDeleteResponse::class);
});

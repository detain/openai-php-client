<?php

use OpenAI\Responses\Skills\SkillListResponse;
use OpenAI\Responses\Skills\SkillResponse;

test('from', function () {
    $result = SkillListResponse::from(skillListResource(), meta());

    expect($result)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(SkillResponse::class)
        ->firstId->toBe('skill_abc123')
        ->lastId->toBe('skill_def456')
        ->hasMore->toBeFalse();
});

test('as array accessible', function () {
    $result = SkillListResponse::from(skillListResource(), meta());

    expect($result['object'])
        ->toBe('list');
});

test('to array', function () {
    $result = SkillListResponse::from(skillListResource(), meta());

    expect($result->toArray())
        ->toBe(skillListResource());
});

test('fake', function () {
    $response = SkillListResponse::fake();

    expect($response)
        ->toBeInstanceOf(SkillListResponse::class)
        ->data->each->toBeInstanceOf(SkillResponse::class);
});

<?php

use OpenAI\Responses\Skills\Versions\SkillVersionListResponse;
use OpenAI\Responses\Skills\Versions\SkillVersionResponse;

test('from', function () {
    $result = SkillVersionListResponse::from(skillVersionListResource(), meta());

    expect($result)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(SkillVersionResponse::class)
        ->firstId->toBe('skillver_abc123')
        ->lastId->toBe('skillver_def456')
        ->hasMore->toBeFalse();
});

test('as array accessible', function () {
    $result = SkillVersionListResponse::from(skillVersionListResource(), meta());

    expect($result['object'])
        ->toBe('list');
});

test('to array', function () {
    $result = SkillVersionListResponse::from(skillVersionListResource(), meta());

    expect($result->toArray())
        ->toBe(skillVersionListResource());
});

test('fake', function () {
    $response = SkillVersionListResponse::fake();

    expect($response)
        ->toBeInstanceOf(SkillVersionListResponse::class)
        ->data->each->toBeInstanceOf(SkillVersionResponse::class);
});

<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Skills\Versions\SkillVersionDeleteResponse;
use OpenAI\Responses\Skills\Versions\SkillVersionListResponse;
use OpenAI\Responses\Skills\Versions\SkillVersionResponse;
use OpenAI\ValueObjects\Transporter\Response;

test('create', function () {
    $client = mockClient('POST', 'skills/skill_abc123/versions', [
        'files' => fileResourceResource(),
        'default' => 'true',
    ], Response::from(skillVersionResource(), metaHeaders()), validateParams: false);

    $result = $client->skills()->versions()->create('skill_abc123', [
        'files' => fileResourceResource(),
        'default' => 'true',
    ]);

    expect($result)
        ->toBeInstanceOf(SkillVersionResponse::class)
        ->id->toBe('skillver_abc123')
        ->object->toBe('skill.version')
        ->createdAt->toBe(1710000000)
        ->skillId->toBe('skill_abc123')
        ->version->toBe('1')
        ->name->toBe('basic-math')
        ->description->toBe('Add or multiply numbers.');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('list', function () {
    $client = mockClient('GET', 'skills/skill_abc123/versions', [
        'order' => 'desc',
    ], Response::from(skillVersionListResource(), metaHeaders()));

    $result = $client->skills()->versions()->list('skill_abc123', [
        'order' => 'desc',
    ]);

    expect($result)
        ->toBeInstanceOf(SkillVersionListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(SkillVersionResponse::class)
        ->firstId->toBe('skillver_abc123')
        ->lastId->toBe('skillver_def456')
        ->hasMore->toBeFalse();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'skills/skill_abc123/versions/1', [], Response::from(skillVersionResource(), metaHeaders()));

    $result = $client->skills()->versions()->retrieve('skill_abc123', '1');

    expect($result)
        ->toBeInstanceOf(SkillVersionResponse::class)
        ->id->toBe('skillver_abc123')
        ->version->toBe('1');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('content', function () {
    $client = mockContentClient('GET', 'skills/skill_abc123/versions/1/content', [], 'zip-bundle');

    $result = $client->skills()->versions()->content('skill_abc123', '1');

    expect($result)->toBe('zip-bundle');
});

test('delete', function () {
    $client = mockClient('DELETE', 'skills/skill_abc123/versions/1', [], Response::from(skillVersionDeleteResource(), metaHeaders()));

    $result = $client->skills()->versions()->delete('skill_abc123', '1');

    expect($result)
        ->toBeInstanceOf(SkillVersionDeleteResponse::class)
        ->id->toBe('skillver_abc123')
        ->object->toBe('skill.version.deleted')
        ->deleted->toBeTrue()
        ->version->toBe('1');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

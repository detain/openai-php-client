<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Skills\SkillDeleteResponse;
use OpenAI\Responses\Skills\SkillListResponse;
use OpenAI\Responses\Skills\SkillResponse;
use OpenAI\ValueObjects\Transporter\Response;

test('create with zip upload', function () {
    $client = mockClient('POST', 'skills', [
        'files' => fileResourceResource(),
    ], Response::from(skillResource(), metaHeaders()), validateParams: false);

    $result = $client->skills()->create([
        'files' => fileResourceResource(),
    ]);

    expect($result)
        ->toBeInstanceOf(SkillResponse::class)
        ->id->toBe('skill_abc123')
        ->object->toBe('skill')
        ->createdAt->toBe(1710000000)
        ->name->toBe('basic-math')
        ->description->toBe('Add or multiply numbers.')
        ->defaultVersion->toBe('1')
        ->latestVersion->toBe('2');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('create with directory upload', function () {
    $client = mockClient('POST', 'skills', [
        'files' => [fileResourceResource(), fileResourceResource()],
    ], Response::from(skillResource(), metaHeaders()), validateParams: false);

    $result = $client->skills()->create([
        'files' => [fileResourceResource(), fileResourceResource()],
    ]);

    expect($result)
        ->toBeInstanceOf(SkillResponse::class)
        ->id->toBe('skill_abc123');
});

test('list', function () {
    $client = mockClient('GET', 'skills', [
        'limit' => 10,
    ], Response::from(skillListResource(), metaHeaders()));

    $result = $client->skills()->list([
        'limit' => 10,
    ]);

    expect($result)
        ->toBeInstanceOf(SkillListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(SkillResponse::class)
        ->firstId->toBe('skill_abc123')
        ->lastId->toBe('skill_def456')
        ->hasMore->toBeFalse();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'skills/skill_abc123', [], Response::from(skillResource(), metaHeaders()));

    $result = $client->skills()->retrieve('skill_abc123');

    expect($result)
        ->toBeInstanceOf(SkillResponse::class)
        ->id->toBe('skill_abc123')
        ->name->toBe('basic-math')
        ->defaultVersion->toBe('1')
        ->latestVersion->toBe('2');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('update', function () {
    $client = mockClient('POST', 'skills/skill_abc123', [
        'default_version' => '2',
    ], Response::from(skillResource(), metaHeaders()));

    $result = $client->skills()->update('skill_abc123', [
        'default_version' => '2',
    ]);

    expect($result)
        ->toBeInstanceOf(SkillResponse::class)
        ->id->toBe('skill_abc123');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('content', function () {
    $client = mockContentClient('GET', 'skills/skill_abc123/content', [], 'zip-bundle');

    $result = $client->skills()->content('skill_abc123');

    expect($result)->toBe('zip-bundle');
});

test('delete', function () {
    $client = mockClient('DELETE', 'skills/skill_abc123', [], Response::from(skillDeleteResource(), metaHeaders()));

    $result = $client->skills()->delete('skill_abc123');

    expect($result)
        ->toBeInstanceOf(SkillDeleteResponse::class)
        ->id->toBe('skill_abc123')
        ->object->toBe('skill.deleted')
        ->deleted->toBeTrue();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

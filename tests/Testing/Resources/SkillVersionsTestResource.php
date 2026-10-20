<?php

use OpenAI\Resources\SkillVersions;
use OpenAI\Responses\Skills\Versions\SkillVersionDeleteResponse;
use OpenAI\Responses\Skills\Versions\SkillVersionListResponse;
use OpenAI\Responses\Skills\Versions\SkillVersionResponse;
use OpenAI\Testing\ClientFake;

it('records a skill versions create request', function () {
    $fake = new ClientFake([
        SkillVersionResponse::fake(),
    ]);

    $fake->skills()->versions()->create('skill_abc123', [
        'files' => fileResourceResource(),
    ]);

    $fake->assertSent(SkillVersions::class, function ($method, $skillId, $parameters) {
        return $method === 'create' &&
            $skillId === 'skill_abc123' &&
            isset($parameters['files']);
    });
});

it('records a skill versions list request', function () {
    $fake = new ClientFake([
        SkillVersionListResponse::fake(),
    ]);

    $fake->skills()->versions()->list('skill_abc123');

    $fake->assertSent(SkillVersions::class, function ($method, $skillId) {
        return $method === 'list' &&
            $skillId === 'skill_abc123';
    });
});

it('records a skill versions retrieve request', function () {
    $fake = new ClientFake([
        SkillVersionResponse::fake(),
    ]);

    $fake->skills()->versions()->retrieve('skill_abc123', '1');

    $fake->assertSent(SkillVersions::class, function ($method, $skillId, $version) {
        return $method === 'retrieve' &&
            $skillId === 'skill_abc123' &&
            $version === '1';
    });
});

it('records a skill versions content request', function () {
    $fake = new ClientFake([
        'zip-bundle',
    ]);

    $fake->skills()->versions()->content('skill_abc123', '1');

    $fake->assertSent(SkillVersions::class, function ($method, $skillId, $version) {
        return $method === 'content' &&
            $skillId === 'skill_abc123' &&
            $version === '1';
    });
});

it('records a skill versions delete request', function () {
    $fake = new ClientFake([
        SkillVersionDeleteResponse::fake(),
    ]);

    $fake->skills()->versions()->delete('skill_abc123', '1');

    $fake->assertSent(SkillVersions::class, function ($method, $skillId, $version) {
        return $method === 'delete' &&
            $skillId === 'skill_abc123' &&
            $version === '1';
    });
});

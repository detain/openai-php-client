<?php

use OpenAI\Resources\Skills;
use OpenAI\Responses\Skills\SkillDeleteResponse;
use OpenAI\Responses\Skills\SkillListResponse;
use OpenAI\Responses\Skills\SkillResponse;
use OpenAI\Testing\ClientFake;

it('records a skills create request', function () {
    $fake = new ClientFake([
        SkillResponse::fake(),
    ]);

    $fake->skills()->create([
        'files' => fileResourceResource(),
    ]);

    $fake->assertSent(Skills::class, function ($method, $parameters) {
        return $method === 'create' &&
            isset($parameters['files']);
    });
});

it('records a skills list request', function () {
    $fake = new ClientFake([
        SkillListResponse::fake(),
    ]);

    $fake->skills()->list([
        'limit' => 10,
    ]);

    $fake->assertSent(Skills::class, function ($method, $parameters) {
        return $method === 'list' &&
            $parameters['limit'] === 10;
    });
});

it('records a skills retrieve request', function () {
    $fake = new ClientFake([
        SkillResponse::fake(),
    ]);

    $fake->skills()->retrieve('skill_abc123');

    $fake->assertSent(Skills::class, function ($method, $id) {
        return $method === 'retrieve' &&
            $id === 'skill_abc123';
    });
});

it('records a skills update request', function () {
    $fake = new ClientFake([
        SkillResponse::fake(),
    ]);

    $fake->skills()->update('skill_abc123', [
        'default_version' => '2',
    ]);

    $fake->assertSent(Skills::class, function ($method, $id, $parameters) {
        return $method === 'update' &&
            $id === 'skill_abc123' &&
            $parameters['default_version'] === '2';
    });
});

it('records a skills content request', function () {
    $fake = new ClientFake([
        'zip-bundle',
    ]);

    $fake->skills()->content('skill_abc123');

    $fake->assertSent(Skills::class, function ($method, $id) {
        return $method === 'content' &&
            $id === 'skill_abc123';
    });
});

it('records a skills delete request', function () {
    $fake = new ClientFake([
        SkillDeleteResponse::fake(),
    ]);

    $fake->skills()->delete('skill_abc123');

    $fake->assertSent(Skills::class, function ($method, $id) {
        return $method === 'delete' &&
            $id === 'skill_abc123';
    });
});

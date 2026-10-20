<?php

/**
 * @return array<string, mixed>
 */
function skillVersionResource(): array
{
    return [
        'id' => 'skillver_abc123',
        'object' => 'skill.version',
        'created_at' => 1710000000,
        'skill_id' => 'skill_abc123',
        'version' => '1',
        'name' => 'basic-math',
        'description' => 'Add or multiply numbers.',
    ];
}

/**
 * @return array<string, mixed>
 */
function skillVersionListResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            skillVersionResource(),
            [
                'id' => 'skillver_def456',
                'object' => 'skill.version',
                'created_at' => 1710002000,
                'skill_id' => 'skill_abc123',
                'version' => '2',
                'name' => 'basic-math',
                'description' => 'Add, multiply or divide numbers.',
            ],
        ],
        'first_id' => 'skillver_abc123',
        'last_id' => 'skillver_def456',
        'has_more' => false,
    ];
}

/**
 * @return array<string, mixed>
 */
function skillVersionDeleteResource(): array
{
    return [
        'id' => 'skillver_abc123',
        'object' => 'skill.version.deleted',
        'deleted' => true,
        'version' => '1',
    ];
}

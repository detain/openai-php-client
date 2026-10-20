<?php

/**
 * @return array<string, mixed>
 */
function skillResource(): array
{
    return [
        'id' => 'skill_abc123',
        'object' => 'skill',
        'created_at' => 1710000000,
        'name' => 'basic-math',
        'description' => 'Add or multiply numbers.',
        'default_version' => '1',
        'latest_version' => '2',
    ];
}

/**
 * @return array<string, mixed>
 */
function skillListResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            skillResource(),
            [
                'id' => 'skill_def456',
                'object' => 'skill',
                'created_at' => 1710001000,
                'name' => 'csv-insights',
                'description' => 'Summarize CSV files and produce a markdown report.',
                'default_version' => '1',
                'latest_version' => '1',
            ],
        ],
        'first_id' => 'skill_abc123',
        'last_id' => 'skill_def456',
        'has_more' => false,
    ];
}

/**
 * @return array<string, mixed>
 */
function skillDeleteResource(): array
{
    return [
        'id' => 'skill_abc123',
        'object' => 'skill.deleted',
        'deleted' => true,
    ];
}

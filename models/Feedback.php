<?php

namespace app\models;

use app\core\ActiveRecord;

class Feedback extends ActiveRecord
{
    public ?int $theme_id = null;
    public int $user_id;
    public ?int $send_to = null;
    public bool $response_required = false;
    public string $heading;
    public string $text;

    static public function tableName(): string
    {
        return 'feedback';
    }

    public function attributes(): array
    {
        return [
          'theme_id',
          'user_id',
          'send_to',
          'response_required',
          'heading',
          'text'
        ];
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [
            'theme_id' =>[
                [self::REQUIRED]
            ],
            'user_id' =>[
                [self::REQUIRED]
            ],
            'send_to' =>[
                [self::REQUIRED]
            ],
            'response_required' =>[
                [self::REQUIRED]
            ],
            'heading' =>[
                [self::REQUIRED],
                [self::MIN, 'min' => 3],
                [self::MAX, 'max' => 30]
            ],
            'text' =>[
                [self::REQUIRED],
                [self::MAX, 'max' => 65535]
            ]
        ];
    }

    public function getLabels(): array
    {
        return [
            'theme_id' => 'Theme',
            'user_id' => '',
            '1' => 'Admins',
            '2' => 'Managers',
            'response_required' => 'Answer me',
            'heading' => 'Heading',
            'text' => 'Text'
        ];
    }

    public function getThemes(): array
    {
        //TODO: Implement selecting themes form db

        return [];
    }

    public function getRoles(): array
    {
        //TODO: Implement selecting roles form db
        return [];
    }

    public function sendFeedback(): bool
    {
        //todo: fix foreign key's in db table feedback
        var_dump($this);
        return false;//$this->save();
    }
}
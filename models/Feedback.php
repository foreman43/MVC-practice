<?php

namespace app\models;

use app\core\ActiveRecord;

class Feedback extends ActiveRecord
{
    public int $themeId;
    public int $userId;
    public bool $forAdmins;
    public bool $forManagers;
    public bool $responseRequired;
    public string $heading;
    public string $text;

    static public function tableName(): string
    {
        return 'feedback';
    }

    public function attributes(): array
    {
        return [
          'id',
          'theme_id',
          'user_id',
          'for_admins',
          'for_managers',
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
            'for_admins' =>[
                [self::REQUIRED]
            ],
            'for_managers' =>[
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
            'id' => '',
            'theme_id' => 'Theme',
            'user_id' => '',
            'for_admins' => '',
            'for_managers' => '',
            'response_required' => 'Answer me',
            'heading' => 'Heading',
            'text' => 'Text'
        ];
    }

    public function sandFeedback(): bool
    {
        return $this->save();
    }
}
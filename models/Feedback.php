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
        return "feedback";
    }

    public function attributes(): array
    {
        return [
            "theme_id",
            "user_id",
            "send_to",
            "response_required",
            "heading",
            "text"
        ];
    }

    public static function primaryKey(): string
    {
        return "id";
    }

    public function rules(): array
    {
        return [
            "theme_id" => [
                [self::REQUIRED]
            ],
            "user_id" => [
                [self::REQUIRED]
            ],
            "send_to" => [
                [self::REQUIRED]
            ],
            "heading" => [
                [self::REQUIRED],
                [self::MIN, "min" => 3],
                [self::MAX, "max" => 30]
            ],
            "text" => [
                [self::REQUIRED],
                [self::MAX, "max" => 65535]
            ]
        ];
    }

    public function getLabels(): array
    {
        return [
            "theme_id" => "Тематика",
            "user_id" => "",
            "response_required" => "Отправьте мне ответ",
            "heading" => "Заголовок",
            "text" => "Текст отзыва"
        ];
    }

    public function getThemes(): array
    {
        $themes = Theme::find();
        $associative = [];
        foreach ($themes as $theme) {
            $associative[$theme->id] = $theme->name;
        }
        return $associative;
    }

    public function getRoles(string $where): array
    {
        $roles = Role::find($where);
        $associative = [];
        foreach ($roles as $role) {
            $associative[$role->id] = $role->name;
        }
        return $associative;
    }

    public function sendFeedback(): bool
    {
        return $this->save();
    }
}
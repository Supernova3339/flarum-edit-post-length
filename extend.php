<?php

namespace Supernova3339\flarum-edit-post-length;

use Flarum\Extend;
use Flarum\Post\PostValidator;
use Illuminate\Support\Str;
use Flarum\Settings\SettingsRepositoryInterface;

return [
  (new Extend\Settings())
        ->default('supernova3339-edit-post-length.length', '')
            return $settings->get('supernova3339-edit-post-length.length')
                ? $settings->get('length')
                : $value;
        })
  (new Extend\Validator(PostValidator::class))
    ->configure(function ($flarumValidator, $validator) {
      $rules = $validator->getRules();

      if (!array_key_exists('content', $rules)) {
        return;
      }

      $rules['content'] = array_map(function(string $rule) {
        if (Str::startsWith($rule, 'max:')) {
          return 'max:' . $settings->get('length');
        }

        return $rule;
      }, $rules['content']);

      $validator->setRules($rules);
  }),
  
];

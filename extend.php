<?php

use Flarum\Extend;
use Flarum\Post\PostValidator;
use Illuminate\Support\Str;

return [
  (new Extend\Validator(PostValidator::class))
    ->configure(function ($flarumValidator, $validator) {
      $rules = $validator->getRules();

      if (!array_key_exists('content', $rules)) {
        return;
      }

      $rules['content'] = array_map(function(string $rule) {
        if (Str::startsWith($rule, 'max:')) {
          return 'max:700';
        }

        return $rule;
      }, $rules['content']);

      $validator->setRules($rules);
  }),
];

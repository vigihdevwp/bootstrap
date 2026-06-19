<?php

declare(strict_types=1);

namespace App\Support;

use VigihdevWP\Bootstrap\Forms\FloatingLabel;
use VigihdevWP\Bootstrap\Forms\Radio;
use Yiisoft\Html\Html;

final class Partial
{

    public static function FloatingLabel(): string
    {
        return implode('', [
            (new FloatingLabel(name: 'person', label: 'Username', icon: 'person'))
                ->inputGroupOptions(['class' => 'mt-3'])
                ->render(),
            (new FloatingLabel(name: 'no_handphone', label: 'No Handphone', icon: 'mobile_friendly'))
                ->inputGroupOptions(['class' => 'mt-3'])
                ->render(),
            (new FloatingLabel(name: 'address', label: 'Address', icon: 'home'))
                ->inputGroupOptions(['class' => 'mt-3'])
                ->render(),
        ]);
    }

    public static function formUpdateUser(): string
    {
        return implode('', [
            (new FloatingLabel(name: 'person', label: 'Username', icon: 'person'))
                ->inputGroupOptions(['class' => 'mt-3'])
                ->render(),
            (new FloatingLabel(name: 'no_handphone', label: 'No Handphone', icon: 'mobile_friendly'))
                ->inputGroupOptions(['class' => 'mt-3'])
                ->render(),
            (new FloatingLabel(name: 'address', label: 'Address', icon: 'home'))
                ->inputGroupOptions(['class' => 'mt-3'])
                ->render(),

            implode('', [
                Html::openTag('div', ['class' => 'd-flex justify-content-end mt-4']),
                Html::button('Update', ['class' => 'btn btn-primary']),
                Html::closeTag('div')
            ]),
        ]);
    }

    public static function formRadioGender(): string
    {
        return implode('', [
            (new Radio(name: "gender", label: 'Male', value: 'male'))->render(),
            (new Radio(name: "gender", label: 'Female', value: 'female'))->render(),
            (new Radio(name: "gender", label: 'Other', value: 'other'))->render()
        ]);
    }
}

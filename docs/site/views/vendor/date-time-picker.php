<?php

use App\Layout\MainLayout;
use App\Models\ThemeColor;
use VigihdevWP\Bootstrap\Forms\DatePicker;
use VigihdevWP\Bootstrap\Forms\DateTimePicker;
use VigihdevWP\Bootstrap\Forms\FloatingLabel;
use VigihdevWP\Bootstrap\Forms\TimePicker;
use Yiisoft\Html\Html;

MainLayout::begin(title: 'Date Time Picker');
$themeColor = new ThemeColor();
?>
<div class="row">
    <div class="col-md-6">
        <div class="card p-3">
            <?= (new FloatingLabel(name: 'person', label: 'Username', icon: 'person'))
                ->inputGroupOptions(['class' => 'mt-3'])
                ->render(); ?>

            <?= (new FloatingLabel(name: 'email', label: 'Email', icon: 'email', type: 'email'))
                ->inputGroupOptions(['class' => 'mt-3'])
                ->render(); ?>

            <?= (new FloatingLabel(name: 'no_handphone', label: 'No Handphone', icon: 'mobile_friendly'))
                ->inputGroupOptions(['class' => 'mt-3'])
                ->render(); ?>

            <div class="row">
                <div class="col-md-6">
                    <?= (new DateTimePicker(name: 'tgl_mulai', label: 'Tgl Mulai', icon: 'calendar_month'))
                        ->inputGroupOptions(['class' => 'mt-3'])
                        ->inputOptions([
                            'id' => 'tgl_mulai',
                            'data-min-date' => date('Y-m-d H:i:s'),
                            'data-max-date' => '2027-06-27 04:55:31',
                            'data-default-date' => date('Y-m-d H:i:s'),
                            'data-format-date' => 'DD-MM-YYYY HH:mm',
                        ])->render(); ?>
                </div>
                <div class="col-md-6">
                    <?= (new DateTimePicker(name: 'tgl_selesai', label: 'Tgl Selesai'))
                        ->inputGroupOptions(['class' => 'mt-3'])
                        ->inputOptions([
                            'data-parent-date' => '#tgl_mulai',
                            'data-min-date' => date('Y-m-d H:i:s'),
                            'data-max-date' => '2027-06-27 04:55:31',
                            'data-default-date' => date('Y-m-d H:i:s'),
                            'data-format-date' => 'DD-MM-YYYY HH:mm',
                        ])
                        ->render(); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= (new TimePicker(name: 'jam_mulai', label: 'Jam Mulai'))
                        ->inputGroupOptions(['class' => 'mt-3'])
                        ->inputOptions([
                            'id' => 'jam_mulai',
                            'data-min-date' => date('Y-m-d H:i:s'),
                            'data-max-date' => '2027-06-27 04:55:31',
                            'data-default-date' => date('Y-m-d H:i:s'),
                            'data-format-date' => 'HH:mm',
                        ])->render(); ?>
                </div>
                <div class="col-md-6">
                    <?= (new TimePicker(name: 'jam_selesai', label: 'Jam Selesai'))
                        ->inputGroupOptions(['class' => 'mt-3'])
                        ->inputOptions([
                            'id' => 'jam_selesai',
                            'data-min-date' => date('Y-m-d H:i:s'),
                            'data-max-date' => '2027-06-27 04:55:31',
                            'data-default-date' => date('Y-m-d H:i:s'),
                            'data-format-date' => 'HH:mm',
                        ])->render(); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= (new DatePicker(name: 'start_date', label: 'Start Date'))
                        ->inputGroupOptions(['class' => 'mt-3'])
                        ->inputOptions([
                            'data-min-date' => date('Y-m-d H:i:s'),
                            'data-max-date' => '2027-06-27 04:55:31',
                            'data-default-date' => date('Y-m-d H:i:s'),
                            'data-format-date' => 'DD-MM-YYYY',
                        ])->render(); ?>
                </div>
                <div class="col-md-6">
                </div>
            </div>

        </div>
        <!-- card -->

    </div>
</div>

<?php MainLayout::end(); ?>
<?php
/**
 * @var \App\View\AppView $this
 */

use Cake\Core\Configure;

?>
<div class="mt-4 p-3 bg-light rounded">
    <h2><?= __('SwRI Generic SOC Setup') ?></h2>
</div>

<div class="row justify-content-center">
    <div class="col-md-9">
        <?= $this->Form->create() ?>

        <?php
        foreach (preg_split("/((\r?\n)|(\r\n?))/", $site_style_vars_file) as $line) {
            echo '<div class="row align-items-center my-3">';
            $line = explode(": ", $line);
            if (!empty($line[1])) {
                $line[1] = str_replace(';', '', $line[1]);
            }
            echo $this->Form->control($line[0], ['default' => $line[1] ?? '', 'type' => 'color']);
            echo '</div>';
        }
        ?>
        <hr>
        <div class="row align-items-center my-3">
            <?php
            echo $this->Form->textarea('site_style_vars', ['default' => $site_style_vars_file ?? '', 'class' => 'form-control'])
            ?>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" class="btn btn-primary"><?= __('Submit') ?></button>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

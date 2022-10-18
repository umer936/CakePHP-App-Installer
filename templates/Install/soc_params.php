<?php
/**
 * @var \App\View\AppView $this
 */

echo $this->Form->create(null, ['id' => 'site_style_vars_form']) ?>

<div class="mt-4 p-3 bg-light rounded position-sticky">
    <h2>
        <?= __('SwRI Generic SOC Setup') ?>
        <button type="submit" class="btn btn-primary float-end"><?= __('Submit') ?></button>
    </h2>
</div>
<br>
<div class="w-100 row">
    <div class="col-md-9">
        <div id="webpage">
        <?php
//        readfile(ROOT . '/plugins/CakePHPAppInstaller/templates/Install/default_soc_page.html');
                readfile(ROOT . '/vendor/cakephp-app-installer/installer/templates/Install/default_soc_page.html');
        ?>
        </div>
    </div>
    <div class="col-md-3 overflow-auto" id="varsDiv">
        <?php
        echo $this->Form->control('mainTitle', [
            'class' => 'form-control',
            'default' => 'Standard website skeleton, easily customizable'
        ]);
        echo $this->Form->control('brand-text', ['class' => 'form-control', 'default' => 'White Label']);

        foreach (preg_split("/((\r?\n)|(\r\n?))/", $site_style_vars_file) as $line) {
            echo '<div class="row align-items-center my-3">';
            $line = explode(": ", $line);
            if (str_contains($line[0], ':root {')) {
                continue;
            }
            if (str_contains($line[0], '}')) {
                break;
            }
            $line[1] = str_replace(';', '', $line[1]);
            $type = str_starts_with($line[1], '#') ? 'color' : 'text';
            echo $this->Form->control($line[0], ['default' => $line[1] ?? '', 'type' => $type]);
            echo '</div>';
        }

        echo $this->Form->control('extra_styles', ['class' => 'form-control', 'type' => 'textarea']);
        ?>
    </div>
</div>
</div>

<?= $this->Form->end() ?>
<style id="style_replace"></style>
<script>
    document.querySelector('#varsDiv').style.height = document.querySelector('#webpage').offsetHeight + "px";

    const form = document.querySelector('form#site_style_vars_form');

    for (const element of form.elements) {
        changeCSSVariable(element.name, element.value);
    }

    form.addEventListener('change', function (event) {
        if (event.target.name === 'mainTitle' || event.target.name === 'brand-text') {
            changeTextVariable(event.target.name, event.target.value);
        }
        else if (event.target.type === 'textarea') {
            document.querySelector('#style_replace').innerHTML = event.target.value;
        }
        else {
            changeCSSVariable(event.target.name, event.target.value);
        }
    });

    function changeTextVariable(variable, value) {
        document.getElementById(variable).textContent = value;
    }

    function changeCSSVariable(variable, value) {
        document.querySelector(':root').style.setProperty(variable.trim(), value);
    }
</script>

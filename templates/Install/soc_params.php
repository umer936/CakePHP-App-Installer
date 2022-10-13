<?php
/**
 * @var \App\View\AppView $this
 */

use Cake\Core\Configure;

?>
<div class="mt-4 p-3 bg-light rounded">
    <h2><?= __('SwRI Generic SOC Setup') ?></h2>
</div>
<?= $this->Form->create() ?>
<div class="row justify-content-center">
    <div class="col-md-9">
        <hr>
        <div class="row align-items-center my-3">
            <?php
            echo $this->Form->textarea('site_style_vars', ['default' => $site_style_vars_file ?? '', 'class' => 'form-control position-sticky'])
            ?>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" class="btn btn-primary"><?= __('Submit') ?></button>
            </div>
        </div>
    </div>
</div>
<div class="w-100 row">
    <div class="col-md-9" contenteditable="true">
        <?php
//        readfile(ROOT . '/plugins/CakePHPAppInstaller/templates/Install/default_soc_page.html');
                readfile(ROOT . '/vendor/cakephp-app-installer/installer/templates/Install/default_soc_page.html');
        ?>
    </div>
    <div class="col-md-3">
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
    </div>
</div>

<?= $this->Form->end() ?>
<style id="style_replace"></style>
<script>
    document.querySelector('[name=site_style_vars]').addEventListener('change', function() {
        document.querySelector('#style_replace').innerHTML = this.value;
    });
    document.querySelector('#style_replace').innerHTML = document.querySelector('[name=site_style_vars]').value;
</script>

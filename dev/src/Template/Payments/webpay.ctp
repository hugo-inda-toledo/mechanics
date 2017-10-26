<div>
    <h3>Espere mientras redireccionamos a transbank</h3>
</div>

<?= $this->Form->create(null,['url' => $url_tb,'id' => 'form_tb']) ?>
    <?php echo $this->Form->hidden('TBK_TOKEN',['value' => $token]) ?>
<?= $this->Form->end() ?>

<script>
    document.getElementById("form_tb").submit();
</script>
<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>

<style>
    .infos{
        text-align: right;
    }
</style>

<?= $this->data["content"] ?>

<?= $this->start("scripts"); ?>
<script>

</script>
<?= $this->end("scripts"); ?>

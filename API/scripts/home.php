<?php
    defined('CONTROL') or die('Acesso restrito');

    $api = new ApiConsumer();
    $countries = $api->get_all_countries();
?>

<div class="container mt-5">
    <div class="row">
        <div class="col text-center">
            <h3 class="text-primary">Países do Mundo!</h3>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-4">
            <p class="text-muted">Lista de Países</p>
            <select id="select_country" class="form-select bg-light text-dark border rounded">
                <option value="">Selecione um País</option>
                <?php foreach($countries as $country): ?>
                    <option value="<?= $country?>"><?= $country?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const select_country = document.querySelector("#select_country");
        select_country.addEventListener('change', () => {
            const country = select_country.value;
            window.location.href = `?route=country&country_name=${country}`;
        });
    });
</script>

<style>
    body {
        background: #f8f9fa;
        color: #343a40;
        font-family: Arial, sans-serif;
    }
    .container {
        max-width: 900px;
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .text-primary {
        color: #007bff;
    }
    .text-muted {
        color: #6c757d;
    }
    .form-select {
        background: #ffffff;
        color: #343a40;
        border: 1px solid #ced4da;
    }
    .form-select:focus {
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        border-color: #80bdff;
    }
</style>

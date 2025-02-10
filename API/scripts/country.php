<?php
    defined('CONTROL') or die('Acesso restrito');

    $api = new ApiConsumer();
    $country = $_GET['country_name'] ?? null;

    if (!$country) {
        header('Location: ?route=home');
        die();
    }

    $country_data = $api->get_country($country);
    $data = $country_data[0] ?? null;

    if (!$data) {
        echo "<p class='text-danger'>País não encontrado.</p>";
        exit;
    }
?>

<div class="container mt-5">
    <div class="d-flex flex-wrap align-items-center gap-4">
        <div class="card p-3 shadow-lg" style="width: 250px; background: #f8f9fa; border: 1px solid #ddd;">
            <img src="<?= $data['flags']['png'] ?>" class="img-fluid rounded">
        </div>
        <div>
            <h1 class="display-4 fw-bold text-dark"> <?= $data['name']['common'] ?> </h1>
            <p class="fs-5 m-0 text-muted"> <strong>Capital:</strong> <?= $data['capital'][0] ?? 'N/A' ?> </p>
            <p class="fs-5 m-0 text-muted"> <strong>Moeda:</strong> <?= implode(', ', array_keys($data['currencies'] ?? [])) ?> </p>
            <p class="fs-5 m-0 text-muted"> <strong>Idioma(s):</strong> <?= implode(', ', $data['languages'] ?? []) ?> </p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <p class="fs-5 text-muted"> <strong>Região:</strong> <?= $data['region'] ?> </p>
            <p class="fs-5 text-muted"> <strong>Sub-Região:</strong> <?= $data['subregion'] ?> </p>
            <p class="fs-5 text-muted"> <strong>População:</strong> <?= number_format($data['population']) ?> habitantes </p>
            <p class="fs-5 text-muted"> <strong>Área:</strong> <?= number_format($data['area']) ?> km<sup>2</sup> </p>
        </div>
        <div class="col-md-6">
            <p class="fs-5 text-muted"> <strong>Fuso Horário:</strong> <?= implode(', ', $data['timezones'] ?? []) ?> </p>
            <p class="fs-5 text-muted"> <strong>Fronteiras:</strong> <?= isset($data['borders']) ? implode(', ', $data['borders']) : 'Nenhuma' ?> </p>
        </div>
    </div>

    <div class="mt-4">
        <a href="?route=home" class="btn btn-secondary px-5 py-2">Voltar</a>
    </div>
</div>

<style>
    body {
        background: #f4f4f4;
        color: #333;
        font-family: Arial, sans-serif;
    }
    .container {
        max-width: 900px;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .card img {
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #ddd;
    }
    .text-dark {
        color: #343a40;
    }
    .text-muted {
        color: #6c757d;
    }
    .btn-secondary {
        background: #6c757d;
        color: #fff;
        border: none;
        transition: 0.3s;
    }
    .btn-secondary:hover {
        background: #5a6268;
    }
</style>
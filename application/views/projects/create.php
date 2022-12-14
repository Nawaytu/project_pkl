<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Insert Data</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="project_name" class="form-label">Project Name</label>
                    <input type="text" name="project_name" class="form-control" id="project_name">
                    <small class="form-text text-danger">
                        <?= form_error('project_name'); ?>
                    </small>
                </div>
                <div class="mb-3">
                    <label for="client_name" class="form-label">Client Name</label>
                    <select name="client_id" class="form-select" aria-label="Default select example">
                        <?php foreach ($clients as $client): ?>
                        <option name="client_id" value="<?= $client['client_id'] ?>">
                            <?= $client['client_name'] ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="project_start" class="form-label">Project Start</label>
                    <input type="date" name="project_start" class="form-control" id="project_start">
                    <small class="form-text text-danger">
                        <?= form_error('project_start'); ?>
                    </small>
                </div>
                <div class="mb-3">
                    <label for="project_end" class="form-label">Project End</label>
                    <input type="date" name="project_end" class="form-control" id="project_end">
                    <small class="form-text text-danger">
                        <?= form_error('project_end'); ?>
                    </small>
                </div>
                <div class="mb-3">
                    <label for="project_status" class="form-label">Status</label>
                    <select name="project_status" class="form-select" aria-label="Default select example">
                        <?php foreach ($status as $status): ?>
                        <option name="project_status" value="<?= $status ?>">
                            <?= $status ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <a href="<?= base_url();?>projects" class="btn btn-warning">Kembali</a>
                <button type="submit" name="create" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </section>
</div>
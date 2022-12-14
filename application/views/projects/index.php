<main>
    <div class="container-fluid px-4">
    <?php if ( $this->session->flashdata('flash') ): ?>
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Data Project 
                    <?= $this->session->flashdata('flash'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    <?php endif; ?>
        <h1 class="mt-4">Dashboard</h1>

        <form action="" method="post">
            <div class="row">
                <div class="col mb-3">
                    <label for="formGroupExampleInput" class="form-label">Filter</label>
                    <input name="keyword" placeholder="Cari data" type="text" class="form-control" id="formGroupExampleInput">
                </div>
                <!-- <div class="col mb-3">
                    <label for="formGroupExampleInput" class="form-label">Client</label>
                    <select name="keyword" class="form-select" aria-label="Default select example">
                        <option name="keyword">Select All</option>
                        <?php foreach ($clients as $client): ?>
                        <option name="keyword" value="<?= $client['client_name'] ?>">
                            <?= $client['client_name'] ?>
                        </option>
                        <?php endforeach; ?>
                    </select>

                </div>
                <div class="col mb-3">
                    <label for="formGroupExampleInput" class="form-label">Status</label>
                    <select name="keyword" class="form-select" aria-label="Default select example">
                        <option  name="keyword">Select All</option>
                        <?php foreach ($status as $status): ?>
                        <option name="keyword" value="<?= $status['project_status'] ?>">
                            <?= $status['project_status'] ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div> -->
                <div class="col mt-2">
                    <button type="submit" class="btn btn-primary mt-4">Search</button>
                    <button type="button" id="button-addon2" class="btn btn-warning mt-4">Clear</button>
                </div>
            </div>
        </form>

        <?= form_open('projects/delete'); ?>
            <a href="<?= base_url('projects/create') ?>" class="btn btn-primary">Tambah Data</a>
            <input class="btn btn-danger" type="submit" value="delete" name="delete" onclick="return confirm('anda yakin')">
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>c</th>
                        <th>Action</th>
                        <th>Project Name</th>
                        <th>Client</th>
                        <th>Project Start</th>
                        <th>Project End</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tb_m_project as $project): ?>
                    <tr>
                        <td>
                            <input class="form-check-input" type="checkbox" name="project_id[]"
                                value="<?= $project['project_id']; ?>">
                        </td>
                        <td>
                            <a href="<?= base_url(); ?>projects/update/<?= $project['project_id']; ?>">Edit</a>
                        </td>
                        <td>
                            <?= $project['project_name'] ?>
                        </td>
                        <td>
                            <?= $project['client_name'] ?>
                        </td>
                        <td>
                            <?= $project['project_start'] ?>
                        </td>
                        <td>
                            <?= $project['project_end'] ?>
                        </td>
                        <td>
                            <?= $project['project_status'] ?>
                        </td>
                    </tr>
                </tbody>
                <?php endforeach; ?>
            </table>
            <?= form_close(); ?>
            <?= $this->pagination->create_links(); ?>
    </div>
</main>
<?php $session = \Config\Services::session(); ?>

<?= $this->extend("layouts/header-new") ?>
<?= $this->section("body") ?>


<div class="holiday ms-4 mt-3">
    <div class="row ms-0 me-0 mt-3 pt-2">
        <div class="col col-lg-9 mt-1">
            <h4>Add New Careers Details</h4>
        </div>
        <div class="col col-lg-3 buttons">
            <a href="<?php echo site_url('careers?&fdate=' . date("2020-01-01") . '&todate=' . date('Y-m-d')) ?>" class="ms-5 cancel"> Cancel</a>
            <a href="javascript:void(0);" id="AddDepartmentformsubmit" class="ms-2"> Save</a>
        </div>
    </div>


    <div class="row ms-1 me-1 mt-3 pt-2 add-holiday">
        <form action="<?php echo site_url('/store-career') ?>" method="post" id="AddDepartmentForm">
            <div class="row ms-3 mt-3 me-2">
                <div class="col-lg-3">
                    <label>Job Title </label>
                    <input type="text" name="JobTitle" id="JobTitle" class="form-control" placeholder="Job Title">
                    <!-- <div class="invalid-feedback">Please provide a valid Job Title.</div> -->
                </div>
                <div class="col-lg-3">
                    <label>Job Type </label>
                    <select class="form-control" name="JobType" id="JobType">
                        <option value="1" selected>Full Time</option>
                        <option value="2">Part Time</option>
                    </select>
                </div>
                <div class="col-lg-3">
                    <label>Job Category </label>
                    <select class="form-control" name="JobCategory" id="JobCategory">
                        <?php foreach ($selectCareerCat as $category) { ?>
                            <option value="<?php echo ($category['job_cat_IDPK']) ?>"><?php echo ($category['job_cat_name']) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-lg-3">
                    <label>Job Experience </label>
                    <select name="JobExperience" id="JobExperience" class="form-control">
                        <?php foreach ($options as $index => $opt) { ?>
                            <option value="<?= $opt['IDPK'] ?>" <?= ($index == 0) ? 'selected' : '' ?>><?= $opt['Options'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row ms-3 mt-3 me-2">
                <div class="col">
                    <label>Company Profile</label>
                    <textarea name="profile" id="profile" class="form-control TinyMCE" placeholder="Company Profile"></textarea>
                    <div class="invalid-feedback">Please provide a valid Company Profile.</div>
                </div>
                <div class="col">
                    <label>Job Overview</label>
                    <textarea name="overview" id="overview" class="form-control TinyMCE" placeholder="Job Overview"></textarea>
                    <div class="invalid-feedback">Please provide a valid Job Overview.</div>
                </div>
            </div>
            <div class="row ms-3 mt-2 me-2">
                <div class="col qualifications">
                    <label>Qualifications</label>
                    <div class="d-flex align-items-center mt-2">
                        <input name="qualifications[]" id="qualifications" class="form-control" style="margin-right: 10px;" placeholder="Qualifications">
                        <button type="button" class="btn btn-success add-button">+</button>
                    </div>
                </div>
                <div class="col skills">
                    <label>Skills</label>
                    <div class="d-flex align-items-center mt-2">
                        <input name="skills[]" id="skills" class="form-control" style="margin-right: 10px;" placeholder="Skills">
                        <button type="button" class="btn btn-success add-button">+</button>
                    </div>
                </div>
            </div>
            <div class="row ms-3 mt-2 me-2">
                <div class="col roles">
                    <label>Roles & Responsibilities</label>
                    <div class="d-flex align-items-center mt-2">
                        <input name="roles[]" id="roles" class="form-control" style="margin-right: 10px;" placeholder="Roles & Responsibilities">
                        <button type="button" class="btn btn-success add-button">+</button>
                        <!-- <div class="invalid-feedback">Please provide a valid Roles & Responsibilities.</div> -->
                    </div>
                </div>
            </div>
            <br>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('#AddDepartmentformsubmit').click(function() {
            $('#roles, #skills, #qualifications, #overview, #profile, #JobTitle').removeClass('is-invalid');
            let flag = [];
            let JobTitle = $('#JobTitle').val().trim();
            let profile = tinymce.get('profile').getContent();
            let overview = tinymce.get('overview').getContent();
            let qualifications = $('#qualifications').val();
            let skills = $('#skills').val().trim();
            let roles = $('#roles').val();

            if (!JobTitle) {
                $('#JobTitle').addClass('is-invalid');
                flag[0] = false;
            }
            if (!profile) {
                $('#profile').addClass('is-invalid');
                flag[1] = false;
            }
            if (!overview) {
                $('#overview').addClass('is-invalid');
                flag[2] = false;
            }
            if (!qualifications) {
                $('#qualifications').addClass('is-invalid');
                flag[3] = false;
            }
            if (!skills) {
                $('#skills').addClass('is-invalid');
                flag[4] = false;
            }
            if (!roles) {
                $('#roles').addClass('is-invalid');
                flag[5] = false;
            }
            for (let index = 0; index < flag.length; index++) {
                if(flag[index] == false){
                return false;
                }
            }
            $('#AddDepartmentForm').submit();
        });

        $('.qualifications').on('click', '.add-button', function() {
            const inputHtml = `<div class="d-flex align-items-center mt-2">
                      <input name="qualifications[]" class="form-control" style="margin-right: 10px;" placeholder="Qualifications">                     
                      <button type="button" class="btn btn-danger remove-button">-</button>
                    </div>`;
            $('.qualifications').append(inputHtml);
        });

        $('.skills').on('click', '.add-button', function() {
            const inputHtml = `<div class="d-flex align-items-center mt-2">
                      <input name="skills[]" class="form-control" style="margin-right: 10px;" placeholder="Skills">                      
                      <button type="button" class="btn btn-danger remove-button">-</button>
                    </div>`;
            $('.skills').append(inputHtml);
        });

        $('.roles').on('click', '.add-button', function() {
            const inputHtml = `<div class="d-flex align-items-center mt-2">
                      <input name="roles[]" class="form-control" style="margin-right: 10px;" placeholder="Roles & Responsibilities">                      
                      <button type="button" class="btn btn-danger remove-button">-</button>
                    </div>`;
            $('.roles').append(inputHtml);
        });

        // Remove input box
        $('.qualifications').on('click', '.remove-button', function() {
            $(this).closest('.d-flex').remove();
        });

        $('.skills').on('click', '.remove-button', function() {
            $(this).closest('.d-flex').remove();
        });

        $('.roles').on('click', '.remove-button', function() {
            $(this).closest('.d-flex').remove();
        });

    });
</script>

<?= $this->endSection() ?>
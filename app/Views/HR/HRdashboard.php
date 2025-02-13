<?php $session = \Config\Services::session(); ?>
<?= $this->extend("layouts/header-new") ?>
<?= $this->section("body") ?>

<?php
    use App\Models\CareerModel;
    $CAREER = new CareerModel();
?>

<style>
    .anniversary-container .table-container .table-hover td{
        font-size: x-small;
    }

    .birthday-container .table-container .table-hover td{
        font-size: x-small;
    }
</style>

<div class="row Hrbased row-lg-12 mt-1">
    <div class="col col-lg-8"></div>
    <div class="col col-lg-4 ps-5 d-flex">
        <input type="hidden" value="<?php echo $HRid; ?>" id="HRid">
        <input type="hidden" value="<?php echo $session->get('EmpIDFK'); ?>" id="HRid">
        <input type="hidden" value="<?php echo $session->get('user_name'); ?>" id="HRNAME">

        <div class="action ms-4 ps-2 mt-2">
            <i class="fa-solid fa-calendar-days ps-2"></i>
            <input class="form-control" type="text" style="padding-left: 35px; box-sizing: border-box;" id="reportrange">
            <?php
            if (empty($fdate)) {
                $fdate = date("Y-m-d");
            }
            ?>
            <input type="hidden" name="fdate" id="fdate" value="<?= $fdate ?>" />
            <?php
            if (empty($todate)) {
                $todate = date("Y-m-d");
            }
            ?>
            <input type="hidden" name="todate" id="todate" value="<?= $todate ?>" />
            <button class="btn btn-primary" style="margin-left: 10px;" onclick="datefilter()">Check</button>
        </div>
    </div>
</div>


<div class="count-container mt-1">
    <div class="row row-lg-12 mt-2">
        <div class="counts ms-4 ps-4">
            <div class="row">
                <a href="<?php echo site_url('/HRcandidate_List?trickid=12&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=&res=') ?>" class="ms-1" id="candidateurl1">
                    <div class="card count-card-1" >
                        <div class="card-body">
                            <div class="row row-lg-11 ms-0 me-0">
                                <div class="col-md-8 count-card-title ps-2">
                                    Fresh Candidates
                                </div>
                                <div class="col-md-4 count-card-icon ms-1">
                                    <img src="<?php echo base_url('../public/images/img/people.png'); ?>">
                                </div>
                            </div>
                            <div class="count-card-cound ps-3">
                                <?php echo ($HRassignedCandidatesCount ?? 0); ?>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="<?php echo site_url('/HRcandidate_List?trickid=1&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=&res=') ?>" class="ms-1" id="candidateurl2">
                    <div class="card count-card-2" >
                        <div class="card-body">
                            <div class="row row-lg-11 ms-0 me-0">
                                <div class="col-md-8 count-card-title ps-2">
                                    Scheduled Candidates
                                </div>
                                <div class="col-md-4 count-card-icon ms-1">
                                    <img src="<?php echo base_url('../public/images/img/calender.png') ?>">
                                </div>
                            </div>
                            <div class="count-card-cound ps-3">
                                <?php echo ($HRscheduledCount ?? 0); ?>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="<?php echo site_url('/HRcandidate_List?trickid=2&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=&res=') ?>" class="ms-1" id="candidateurl3">
                    <div class="card count-card-3" >
                        <div class="card-body">
                            <div class="row row-lg-11 ms-0 me-0">
                                <div class="col-md-8 count-card-title ps-2">
                                    Not Scheduled Candidates
                                </div>
                                <div class="col-md-4 count-card-icon ms-1">
                                    <img src="<?php echo base_url('../public/images/img/calender-cut.png') ?>">
                                </div>
                            </div>
                            <div class="count-card-cound ps-3">
                                <?php echo ($HRnotScheduledCount ?? 0); ?>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="<?php echo site_url('/HRcandidate_List?trickid=4&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=&res=') ?>" class="ms-1 mt-2" id="candidateurl4">
                    <div class="card count-card-4" >
                        <div class="card-body">
                            <div class="row row-lg-11 ms-0 me-0">
                                <div class="col-md-8 count-card-title ps-2">
                                    Shortlisted Candidates
                                </div>
                                <div class="col-md-4 count-card-icon ms-1">
                                    <img src="<?php echo base_url('../public/images/img/usertick.png') ?>">
                                </div>
                            </div>
                            <div class="count-card-cound ps-3">
                                <?php echo ($HRSelectedCandidatesCount ?? 0); ?>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="<?php echo site_url('/HRcandidate_List?trickid=5&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=&res=') ?>" class="ms-1 mt-2" id="candidateurl5">
                    <div class="card count-card-5" >
                        <div class="card-body">
                            <div class="row row-lg-11 ms-0 me-0">
                                <div class="col-md-8 count-card-title ps-2">
                                    Rejected Candidates
                                </div>
                                <div class="col-md-4 count-card-icon ms-1">
                                    <img src="<?php echo base_url('../public/images/img/userminus.png') ?>">
                                </div>
                            </div>
                            <div class="count-card-cound ps-3">
                                <?php echo ($HRrejectedCandidatesCount ?? 0); ?>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="<?php echo site_url('/HRcandidate_List?trickid=8&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=&res=') ?>" class="ms-1 mt-2" id="candidateurl6">
                    <div class="card count-card-6" >
                        <div class="card-body">
                            <div class="row row-lg-11 ms-0 me-0">
                                <div class="col-md-8 count-card-title ps-2">
                                    Hired Candidates
                                </div>
                                <div class="col-md-4 count-card-icon ms-1">
                                    <img src="<?php echo base_url('../public/images/img/user-star.png') ?>">
                                </div>
                            </div>
                            <div class="count-card-cound ps-3">
                                <?php echo ($HRJoinedCandidatesCount ?? 0); ?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="events pt-1">
            <div class="row row-lg-12">
                <div class="col-md-8">
                    <span>Events & Announcements</span>
                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-circle-plus"></i></a>
                </div>
                <div class="col-md-4" style="text-align: end;">
                    <span><a href="<?= base_url('allevents') ?>"> View More <i class="fa-solid fa-angles-right"></i></a></span>
                </div>
            </div>
            <?php foreach ($events as $event): ?>
                <div class="event-data">
                    <div class="row row-lg-12">
                        <div class="col-md-8">
                            <span><b><?= $event['EventName'] ?> <?= date('d/m/y', strtotime($event['EventDate'])) ?></b></span>
                        </div>
                        <div class="col-md-4 event-date">
                            <span><?= date('d M Y, h:i A', strtotime($event['EventDate'])) ?></span>
                        </div>
                    </div>
                    <div class="row row-lg-12">
                        <span><?= $event['EventDescription'] ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="row row-lg-12">
    <div class="col-md-6 ms-2 ps-2">
        <div class="job-container ms-4 mt-2 pb-2 pt-1">
            <div class="col ms-2">
                <span>Job Vacancy</span>
                <a href="<?php echo (base_url('add-career')); ?>"><i class="fa-solid fa-circle-plus"></i></a>
            </div>
            <table class="table table-hover ms-3">
                <thead>
                    <tr>
                        <td>JOB TITLE</td>
                        <td>APPLICATIONS</td>
                        <td>POSTED ON</td>
                        <td>STATUS</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($allCareerList)): ?>
                        <?php foreach ($allCareerList as $index => $career): ?>
                            <?php if ($index >= 6) break; ?>
                            <tr>
                                <td><?= $career['job_Title']; ?></td>
                                <td><?= $CAREER->NofApplicants($career['job_IDPK'], ['fdate' => '2020-01-01', 'todate' => date('Y-m-d')]); ?> Applied</td>
                                <td><?= $career['update_date']; ?></td>
                                <td style="color:<?= $career['active_Id'] ? 'green' : 'red'; ?>">
                                    <?= $career['active_Id'] ? 'ACTIVE' : 'INACTIVE'; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="viewmore">
                <a href="<?php echo (base_url('careers?fdate=2020-01-01&todate=' . date('Y-m-d'))); ?>"><i class="fa-solid fa-angles-down"></i> View More</a>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="birthday-container mt-2 pt-1">
            <div class="col ms-2">
                <span>Upcomming Birthdays</span>
            </div>
            <div class="table-container">
                <table class="table table-hover ms-3">
                    <thead>
                        <tr>
                            <td>EMPLOYEE CODE</td>
                            <td>EMPLOYEE NAME</td>
                            <td>DESIGNATION</td>
                            <td>DOB</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($birthdays):
                            foreach ($birthdays as $birthday): ?>
                                <tr>
                                    <td><?php echo $birthday['EmployeeCode']; ?></td>
                                    <td><?php echo $birthday['EmployeeName']; ?></td>
                                    <td><?php echo $birthday['designations']; ?></td>
                                    <td><?php echo $birthday['DOB']; ?></td>
                                </tr>
                        <?php endforeach;
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="anniversary-container mt-2 pt-1">
            <div class="col ms-2">
                <span>Upcomming Anniversary</span>
            </div>
            <div class="table-container">
                <table class="table table-hover ms-3">
                    <thead>
                        <tr>
                            <td>EMPLOYEE CODE</td>
                            <td>EMPLOYEE NAME</td>
                            <td>JOINING DATE</td>
                            <td>EXPERIENCE</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($workAnniversarys):
                            foreach ($workAnniversarys as $Anniversary): ?>
                                <tr>
                                    <td><?php echo $Anniversary['EmployeeCode']; ?></td>
                                    <td><?php echo $Anniversary['EmployeeName']; ?></td>
                                    <td><?php echo $Anniversary['DOJ']; ?></td>
                                    <td><?php echo $Anniversary['years'] . ' Years ' . $Anniversary['months'] . ' Months '; ?></td>
                                </tr>
                        <?php endforeach;
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Events & Announcements</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= site_url('addevent') ?>" method="post">
                <div class="modal-body">
                    <div class="form-check form-check-inline mb-3">
                        <input class="form-check-input" type="radio" name="Type" id="type1" value="1" checked>
                        <label class="form-check-label" for="type1">Event</label>
                    </div>
                    <div class="form-check form-check-inline mb-3">
                        <input class="form-check-input" type="radio" name="Type" id="type2" value="2">
                        <label class="form-check-label" for="type2">Announcement</label>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" name="EventName" id="evt-title" placeholder="Write your subject heading here.">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="EventDescription" id="evt-description" rows="5" placeholder="Write a message here to share with employees."></textarea>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="datetime-local" name="EventDate">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Share <i class="fa-solid fa-paper-plane"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>










<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-4">
          <h1 class="m-0">HR Dashboard</h1>
          <input type="hidden" value="<?php echo $session->get('EmpIDFK'); ?>" id="HRid">
          <input type="hidden" value="<?php echo $session->get('user_name'); ?>" id="HRNAME">
        </div>
        <div class="col-sm-8 pl-0">
          <div class="d-flex justify-content-end ">
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                  </span>
                </div>
                <input type="text" class="form-control float-right" id="reportrange">
                <?php if (empty($fdate)) {
                  $fdate = date("Y-m-d");
                }
                ?>
                <input type="hidden" name="fdate" id="fdate" value="<?= $fdate ?>" />
                <?php if (empty($todate)) {
                  $todate = date("Y-m-d");
                }
                ?>
                <input type="hidden" name="todate" id="todate" value="<?= $todate ?>" />
                <button class="btn bg-orange" onclick="datefilter()">Check</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->
  <!-- <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-6">
          <div class="small-box bg-secondary">
            <div class="inner">
              <h3><?= $HRassignedCandidatesCount ?></h3>
              <p>Fresh Candidates List</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-people-arrows"></i>
            </div>
            <a href="<?php echo site_url('/HRcandidate_List?trickid=12&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=&res=') ?>" class="small-box-footer" id="candidateurl1">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= $HRscheduledCount ?></h3>
              <p>Scheduled Candidates</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-users-viewfinder"></i>
            </div>
            <a href="<?php echo site_url('/HRcandidate_List?trickid=1&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=&res=') ?>" class="small-box-footer" id="candidateurl2">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-6">
          <div class="small-box bg-lime-green">
            <div class="inner">
              <h3><?= $HRnotScheduledCount ?></h3>
              <p>Not-Scheduled Candidates</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-layer-group"></i>
            </div>
            <a href="<?php echo site_url('/HRcandidate_List?trickid=2&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=&res=') ?>" class="small-box-footer" id="candidateurl3">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= $HRSelectedCandidatesCount ?></h3>
              <p>Selected Candidates </p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-person-chalkboard"></i>
            </div>
            <a href="<?php echo site_url('/HRcandidate_List?trickid=4&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=&res=') ?>" class="small-box-footer" id="candidateurl4">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?= $HRrejectedCandidatesCount ?></h3>
              <p>Rejected Candidates</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-users-slash"></i>
            </div>
            <a href="<?php echo site_url('/HRcandidate_List?trickid=5&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=&res=') ?>" class="small-box-footer" id="candidateurl5">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= $HRJoinedCandidatesCount ?></h3>
              <p>Joined Candidates</p>
            </div>
            <div class="icon">
              <i class="fa-regular fa-id-card"></i>
            </div>
            <a href="<?php echo site_url('/HRcandidate_List?trickid=8&fs=&fd=&hr=&fsd-1=&fed-1=&fsd-2=&fed-2=&res=') ?>" class="small-box-footer" id="candidateurl6">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div> -->
<!-- /.content-wrapper -->

<script>
  $(document).ready(function() {
    $('#reportrange').daterangepicker({
        format: 'YYYY/MM/DD',
        locale: {
            format: 'YYYY/MM/DD'
        },
        startDate: '<?= date("Y/m/d", strtotime($fdate)) ?>',
        endDate: '<?= date("Y/m/d", strtotime($todate)) ?>',
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
    }, function(start, end, label) {
        // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });

    for (let i = 1; i <= 6; i++) {
      let candidateUrl = $(`#candidateurl${i}`).attr('href').replaceAll('&hr=', '&hr=' + $('#HRNAME').val().replaceAll(' ', '%20'));
      if (i != 2) {
        candidateUrl = candidateUrl.replaceAll('&fsd-2=', '&fsd-2=' + $('#fdate').val());
        candidateUrl = candidateUrl.replaceAll('&fed-2=', '&fed-2=' + $('#todate').val());
      } else {
        candidateUrl = candidateUrl.replaceAll('&fsd-1=', '&fsd-1=' + $('#fdate').val());
        candidateUrl = candidateUrl.replaceAll('&fed-1=', '&fed-1=' + $('#todate').val());
      }
      $(`#candidateurl${i}`).attr('href', candidateUrl);
    }
  });

  function datefilter() {
    var daterange = document.getElementById("reportrange").value;
    var temp1 = daterange.split('-').pop();
    var dateString1 = temp1.replaceAll('/', "-");
    var todateid = moment(dateString1).format('YYYY-MM-DD');
    var temp2 = daterange.slice(0, 10);
    var dateString2 = temp2.replaceAll('/', "-");
    var fromdateid = moment(dateString2).format('YYYY-MM-DD');
    // alert(todateid);
    window.location.href = 'HRdashboard?&fdate=' + fromdateid + '&todate=' + todateid;

  }
</script>

<?= $this->endSection() ?>
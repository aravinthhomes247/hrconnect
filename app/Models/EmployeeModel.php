<?php

namespace App\Models;

use Codeigniter\Controller\HRController;
use CodeIgniter\Model;
use DateTime;

class EmployeeModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'employees';
    protected $primaryKey       = 'EmployeeId';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'EmployeeId',
        'EmployeeName',
        'EmployeeCode',
        'EmployeeCodeInDevice',
        'StringCode',
        'NumericCode',
        'Gender',
        'DepartmentId',
        'Designation',
        'DesignationIDFK',
        'ReportManagerIDFK',
        'DOJ',
        'EmployementType',
        'Status',
        'FatherName',
        'MotherName',
        'ResidentialAddress',
        'PermanentAddress',
        'ContactNo',
        'AltContactno',
        'EContactNo',
        'Email',
        'PersonalMail',
        'DOB',
        'DOR',
        'PlaceOfBirth',
        'BLOODGROUP',
        'Image',
        'Salary_date',
        'RecordStatus',
        'ContractPeriod',
        'Aadhar_No',
        'PAN_No',
        'UAN_No'
    ];
    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected $bio;

    public function __construct()
    {
        parent::__construct();
        $this->db      = \Config\Database::connect('default');
        $this->bio = \Config\Database::connect('biometric');
    }

    function get_EmpCode($EmpCode)
    {
        $sql = "SELECT * FROM employees WHERE EmployeeCode = ? LIMIT 1";
        $query = $this->db->query($sql, [$EmpCode]);

        $row = $query->getRow();

        if ($row) {
            return true;
        }

        return false;
    }

    public function insert_employeesHomes($data)
    {
        $EmployeeName = $data['EmployeeName'];
        $EmployeeCode = $data['EmployeeCode'];
        $EmployeeCodeInDevice = $data['EmployeeCodeInDevice'];
        $StringCode = $data['StringCode'];
        $NumericCode = $data['NumericCode'];
        $Gender = $data['Gender'];
        $DepartmentId = $data['DepartmentId'];
        $DesignationIDFK = $data['DesignationIDFK'];
        $DOJ =  $data['DOJ'];
        $DOR = '3000-01-01 00:00:00';
        $EmployementType =  'Permanent';
        $Status = 'Working';
        $FatherName =  $data['FatherName'];
        $MotherName = $data['MotherName'];
        $ResidentialAddress = $data['ResidentialAddress'];
        $PermanentAddress = $data['PermanentAddress'];
        $ContactNo =  $data['ContactNo'];
        $AltContactno =  $data['AltContactno'];
        $Email = $data['Email'];
        $PersonalMail = $data['PersonalMail'];
        $DOB = $data['DOB'];
        $PlaceOfBirth =  $data['PlaceOfBirth'];
        $BLOODGROUP = $data['BLOODGROUP'];
        $Image = $data['Image'];
        $DOC = '1900-01-01 00:00:00';
        $EContactNo = $data['EContactNo'];

        $sql = "INSERT INTO biometric.employees(`EmployeeName`, `EmployeeCode`, `EmployeeCodeInDevice`, `StringCode`, `NumericCode`, `Gender`, `DepartmentId`,  
                                                `DesignationIDFK`, `DOJ` , `DOR` , `EmployementType` , `Status`, `FatherName`, `MotherName`, `ResidentialAddress`, 
                                                `PermanentAddress`, `ContactNo`,`AltContactno`, `Email` ,`PersonalMail`, `DOB`, `PlaceOfBirth` ,  `BLOODGROUP`, `Image`,
                                                `RecordStatus`,`CompanyId`, `CategoryId`, `EmployeeDeviceGroup`,`DOC`)  
                VALUES('$EmployeeName','$EmployeeCode', '$EmployeeCodeInDevice', '$StringCode', '$NumericCode', '$Gender', '$DepartmentId',  '$DesignationIDFK', 
                       '$DOJ' , '$DOR' , '$EmployementType' , '$Status', '$FatherName', '$MotherName', '$ResidentialAddress', '$PermanentAddress', '$ContactNo',
                       '$AltContactno', '$Email' ,'$PersonalMail', '$DOB', '$PlaceOfBirth' ,  '$BLOODGROUP', '$Image', '1', '1', '1', '1','$DOC')";

        $this->db->query($sql);
    }

    public function insertsalaryinfo($data)
    {
        $EmployeeIDFK = $data['EmployeeIDFK'];
        $BasicSalary = $data['BasicSalary'];
        $HRA = $data['HRA'];
        $FBP = $data['FBP'];
        $PF = $data['PF'];
        $PT = $data['PT'];
        $PF_VOL = $data['PF_VOL'];
        $Insurance = $data['Insurance'];
        $SD = $data['SD'];
        $GrossSalary = $data['GrossSalary'];
        $NetSalary = $data['NetSalary'];

        $sql = "INSERT INTO `salary_info`(`EmployeeIDFK`, `BasicSalary`, `HRA`, `FBP`, `PF`, `PT`, `PF_VOL`, `Insurance`, `SD`, `GrossSalary`, `NetSalary`) 
              VALUES ($EmployeeIDFK,$BasicSalary,$HRA,$FBP,$PF,$PT,$PF_VOL,$Insurance,$SD,$GrossSalary,$NetSalary)";

        $this->db->query($sql);
    }

    public function insertbankaccinfo($data){
        $EmployeeIDFK = $data['EmployeeIDFK'];
        $AccountHolderName = $data['AccountHolderName'];
        $BankName = $data['BankName'];
        $AccountNo = $data['AccountNo'];
        $IFSCode = $data['IFSCode'];
        $BankBranch = $data['BankBranch'];
        $Mode = $data['Mode'];
        $Type = $data['Type'];

        $sql = "INSERT INTO `emp_bank_details`(`EmployeeIDFK`, `AccountHolderName`, `BankName`, `AccountNo`, `IFSCode`, `BankBranch`, `Mode`, `Type`) 
                VALUES ($EmployeeIDFK,'$AccountHolderName','$BankName','$AccountNo','$IFSCode','$BankBranch',$Mode,$Type)";
        $this->db->query($sql);
    }

    public function update_employeesHomes($data, $EmployeeId)
    {
        $EmployeeName = $data['EmployeeName'];
        $EmployeeCode = $data['EmployeeCode'];
        $EmployeeCodeInDevice = $data['EmployeeCodeInDevice'];
        $StringCode = $data['StringCode'];
        $NumericCode = $data['NumericCode'];
        $Gender = $data['Gender'];
        $DepartmentId = $data['DepartmentId'];
        $DesignationIDFK = $data['DesignationIDFK'];
        $DOJ =  $data['DOJ'];
        $DOR = '3000-01-01 00:00:00';
        $EmployementType =  'Permanent';
        $Status = 'Working';
        $FatherName =  $data['FatherName'];
        $MotherName = $data['MotherName'];
        $ResidentialAddress = $data['ResidentialAddress'];
        $PermanentAddress = $data['PermanentAddress'];
        $ContactNo =  $data['ContactNo'];
        $AltContactno =  $data['AltContactno'];
        $Email = $data['Email'];
        $PersonalMail = $data['PersonalMail'];
        $DOB = $data['DOB'];
        $PlaceOfBirth =  $data['PlaceOfBirth'];
        $BLOODGROUP = $data['BLOODGROUP'];
        $Image = $data['Image'];
        $DOC = '1900-01-01 00:00:00';
        $Salary_date = $data['Salary_date'] ?? 5;
        $RecordStatus = $data['RecordStatus'] ?? null;
        $ContractPeriod = $data['ContractPeriod'] ?? '0 years';
        $Aadhar_No = $data['Aadhar_No'] ?? null;
        $PAN_No = $data['PAN_No'] ?? null;
        $UAN_No = $data['UAN_No'] ?? null;

        $sql = "UPDATE  biometric.employees SET `EmployeeName` = '$EmployeeName', `EmployeeCode` = '$EmployeeCode', `EmployeeCodeInDevice`='$EmployeeCodeInDevice', `StringCode`='$StringCode', `NumericCode`='$NumericCode', `Gender`='$Gender', `DepartmentId`='$DepartmentId',  `DesignationIDFK`='$DesignationIDFK', `DOJ`='$DOJ' , `DOR`='$DOR' , `EmployementType`='$EmployementType' , `Status`='$Status', `FatherName`='$FatherName', `MotherName`='$MotherName', `ResidentialAddress`='$ResidentialAddress', `PermanentAddress`='$PermanentAddress', `ContactNo`='$ContactNo',`AltContactno`='$AltContactno', `Email` ='$Email',`PersonalMail`='$PersonalMail', `DOB`='$DOB', `PlaceOfBirth`='$PlaceOfBirth' ,  `BLOODGROUP`='$BLOODGROUP', `Image`='$Image',`DOC`='$DOC',`RecordStatus`='1',`CompanyId`='1', `CategoryId`='1', `EmployeeDeviceGroup`='1', `Salary_date` = $Salary_date,`ContractPeriod` = '$ContractPeriod',`Aadhar_No` = '$Aadhar_No',`PAN_No` = '$PAN_No',`UAN_No`='$UAN_No' WHERE `employees`.`EmployeeId` = '$EmployeeId' ";


        // print_r($sql);exit();

        // $data['neweEmp'] =
        $this->db->query($sql);
    }


    public function allEmpsCountM()
    {

        $sql = "SELECT * FROM `employees` A LEFT JOIN `designation` ON designation.IDPK=A.DesignationIDFK 
        Where A.Status = 'Working' ORDER BY A.`EmployeeName` ASC";
        $data['allEmpsCount'] = $this->db->query($sql)->getResultArray();
        return $data['allEmpsCount'];
    }
    public function allEmpsListM($data)
    {

        $trickid = $data['trickid'];
        if ($data['trickid'] == 1) {
            $trick = "Where A.Status = 'Working'";
        } elseif ($data['trickid'] == 2) {
            $trick = "Where A.Status = 'InActive'";
        } elseif ($data['trickid'] == 3) {
            $trick = " ";
        } elseif ($data['trickid'] == 4) {
            $trick = "Where A.Status = 'Abscond' ";
        }

        $sql = "  SELECT D.CandidateId ,A.EmployeeId ,A.EmployeeName, A.EmployeeCode, A.Gender, B.designations, C.EmployeeTypeName,E.DV_IDPK,E.DVStatus, E.OfferLetterImage , E.INT_CON_Letter, F.EBD_IDPK, F.EmployeeIDFK FROM `employees` A 
                LEFT JOIN `designation` B ON B.IDPK=A.DesignationIDFK 
                LEFT JOIN employement_type C ON C.IDPK= A.EmployementType 
                LEFT JOIN candidates D ON D.EmployeeIDFK = A.EmployeeID
                LEFT JOIN document_verification E ON E.CandidateIDFK = D.CandidateId
                LEFT JOIN emp_bank_details F ON F.EmployeeIDFK = A.EmployeeId
                $trick ORDER BY A.`EmployeeName` ASC";


        $data['allEmpsList'] = $this->db->query($sql)->getResultArray(); //run the query

        // print_r($data['allEmpsList']);exit;
        return $data['allEmpsList'];
    }
    public function activeCountM()
    {

        $sql = "SELECT COUNT(Status) as active FROM `employees` Where Status='Working' ";

        $data['active'] = $this->db->query($sql)->getResultArray(); //run the query

        // print_r($data);      exit;
        return $data['active'];
    }
    public function inActiveCountM()
    {

        $sql = "SELECT COUNT(Status) as inactive FROM `employees` Where Status='InActive' ";

        $data['inactive'] = $this->db->query($sql)->getResultArray(); //run the query

        // print_r($data);      exit;
        return $data['inactive'];
    }
    public function abscondCountM()
    {
        $sql = "SELECT COUNT(Status) as abscond FROM `employees` Where Status='Abscond' ";
        $data['abscond'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data);      exit;
        return $data['abscond'];
    }
    public function allEmpCountM()
    {
        $sql = "SELECT COUNT(Status) as count FROM `employees` ";
        $data['allEmpCount'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data);      exit;
        return $data['allEmpCount'];
    }
    public function birthdayDetails()
    {
        $sql = "SELECT EmployeeName, EmployeeCode, Image, Date(DOB) as DOB, CURRENT_DATE() as today, 
                       TIMESTAMPDIFF(YEAR, DOB, CURRENT_DATE()) as years, TIMESTAMPDIFF(MONTH, DOB, CURRENT_DATE()) % 12 as months, 
                       FLOOR(TIMESTAMPDIFF(DAY, DOB, CURRENT_DATE()) % 30.4375) as days, B.designations
                FROM employees A LEFT JOIN `designation` B ON B.IDPK = A.DesignationIDFK
                WHERE A.Status = 'Working' AND ((MONTH(DOB) = MONTH(CURRENT_DATE()) AND DAY(DOB) >= DAY(CURRENT_DATE())) 
                OR MONTH(DOB) = MONTH(CURRENT_DATE() + INTERVAL 1 MONTH))
                ORDER BY months DESC, days DESC";
        $data['birthdayDetailsTable'] = $this->db->query($sql)->getResultArray(); //run the query
        return $data['birthdayDetailsTable'];
        // print_r($data['birthdayDetailsTable']);  // exit;
    }

    public function workAnniversaryDetails()
    {
        $sql = "SELECT EmployeeName,EmployeeCode, Date(DOJ) as DOJ , CURRENT_DATE() as today , TIMESTAMPDIFF( YEAR, DOJ, CURRENT_DATE ) as years , TIMESTAMPDIFF( MONTH, DOJ, CURRENT_DATE ) % 12 as months , FLOOR( TIMESTAMPDIFF( DAY, DOJ, CURRENT_DATE ) % 30.4375 ) as days FROM employees A Where A.Status='Working' ORDER BY months DESC, days DESC LIMIT 4";
        $data['workAnniversaryDetailsTable'] = $this->db->query($sql)->getResultArray(); //run the query

        // print_r($data['workAnniversaryDetailsTable']);  // exit;

        return $data['workAnniversaryDetailsTable'];
    }
    public function allworkAnniversaryDetails()
    {

        $sql = "SELECT EmployeeName,EmployeeCode, Date(DOJ) as DOJ , CURRENT_DATE() as today , TIMESTAMPDIFF( YEAR, DOJ, CURRENT_DATE ) as years , TIMESTAMPDIFF( MONTH, DOJ, CURRENT_DATE ) % 12 as months , FLOOR( TIMESTAMPDIFF( DAY, DOJ, CURRENT_DATE ) % 30.4375 ) as days FROM employees A Where A.Status='Working' ORDER BY months DESC, days DESC";

        $data['allworkAnniversaryDetailsTable'] = $this->db->query($sql)->getResultArray(); //run the query

        return $data['allworkAnniversaryDetailsTable'];
    }

    public function allBrirthdaysDetails()
    {

        $sql = "SELECT EmployeeName,EmployeeCode, Date(DOB) as DOB, CURRENT_DATE() as today , TIMESTAMPDIFF( YEAR, DOB, CURRENT_DATE ) as years , TIMESTAMPDIFF( MONTH, DOB, CURRENT_DATE ) % 12 as months , FLOOR( TIMESTAMPDIFF( DAY, DOB, CURRENT_DATE ) % 30.4375 ) as days FROM employees A where A.Status='Working'  ORDER BY months DESC, `days` DESC";

        $data['allbirthdaysDetailsTable'] = $this->db->query($sql)->getResultArray(); //run the query

        return $data['allbirthdaysDetailsTable'];
    }

    public function eventsDetails()
    {
        $sql = "SELECT EventName,EventDate,EventDescription FROM events WHERE MONTH(EventDate)=MONTH(now()) OR DATE(EventDate)>=CURRENT_DATE() ORDER BY EventDate ASC LIMIT 3";
        $data['eventsDetailsTable'] = $this->db->query($sql)->getResultArray(); //run the query
        return $data['eventsDetailsTable'];
    }

    public function selectEmpTypeM()
    {
        $sql = "SELECT * FROM `employement_type` ORDER BY EmployeeTypeName ASC";
        $data['selectEmpType'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['selectdepart']); exit();
        return $data['selectEmpType'];
    }
    public function selectdepartM()
    {
        $sql = "SELECT * FROM `departments` ORDER BY deptName ASC";
        $data['selectdepart'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['selectdepart']); exit();
        return $data['selectdepart'];
    }
    public function selectdesignationM()
    {
        $sql = "SELECT * FROM `designation` ORDER BY designations ASC";
        $data['selectdesignation'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['selectdesignation']); exit();
        return $data['selectdesignation'];
    }
    public function getdesignationM($desname)
    {

        $sql = "SELECT A.EmployeeCode, A.EmployeeName, designation.IDPK, designations FROM `employees` A 
                LEFT JOIN designation ON designation.IDPK = A.DesignationIDFK 
                Where IDPK='$desname' ";
        $data['showdesignation'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['showdesignation']); exit();
        return $data['showdesignation'];
    }

    public function getHR()
    {
        $sql = "SELECT A.EmployeeId, A.EmployeeCode, A.EmployeeName, designation.IDPK, designations FROM `employees` A 
                LEFT JOIN designation ON designation.IDPK = A.DesignationIDFK 
                Where (DesignationIDFK = 18 OR DesignationIDFK = 24) AND `Status` = 'Working' ";
        $data['showHR'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['showdesignation']); exit();
        return $data['showHR'];
    }

    public function showAbsentEmpM($id, $AbsentDate)
    {
        // print_r($AbsentDate); exit();
        $sql = "SELECT e.EmployeeId AS EmployeeId, e.EmployeeCode AS `EmployeeCode`, e.EmployeeName, '$AbsentDate' as AbsentDate
        FROM  employees e 
        WHERE e.EmployeeId='$id' ";

        $data['showAbsentEmpDetails'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['showAbsentEmpDetails']); exit();
        return $data['showAbsentEmpDetails'];
    }

    public function getEmpLeaveTaken($id)
    {
        // print_r($id); exit();
        $sql = "SELECT mail_base.Mail_IDPK , absents_leave_request.IDPK as IDPK,absents_leave_request.EmployeeIDFK,leavereason.LeaveReason as LeaveReason, absentDate as AbsentDate ,mail_base.Mail_Msg as Reason
                FROM `absents_leave_request` 
                LEFT JOIN leavereason ON leavereason.IDPK = leaveReasonIDFK 
                LEFT JOIN mail_base ON mail_base.Mail_IDPK = absents_leave_request.Mail_Base_IDFK
               WHERE absents_leave_request.EmployeeIDFK= '$id' ";

        $data['EmpLeaveTaken'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['EmpLeaveTaken']); exit();
        return $data['EmpLeaveTaken'];
    }
    public function getEmpALRid($id, $idpk)
    {
        // print_r($idpk); exit();
        $sql = "SELECT absents_leave_request.IDPK as IDPK ,leavereason.LeaveReason as LeaveReason, absentDate as AbsentDate, mail_base.Mail_Msg as Reason,EmployeeIDFK FROM `absents_leave_request` LEFT JOIN leavereason ON leavereason.IDPK = leaveReasonIDFK LEFT JOIN mail_base ON mail_base.Mail_IDPK = absents_leave_request.Mail_Base_IDFK WHERE EmployeeIDFK= '$id' and absents_leave_request.IDPK = '$idpk'";

        $data['ALRid'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['ALRid']); exit();
        return $data['ALRid'];
    }

    // public function getLeaveReasonM(){

    //     $sql="SELECT * FROM `absents_leave_request` 
    //             LEFT JOIN leavereason ON `leavereason`.`IDPK` = absents_leave_request.leaveReasonIDFK
    //             LEFT JOIN employees C ON C.`EmployeeId` = absents_leave_request.EmployeeIDFK ";
    //     $data['showleavereason'] = $this->db->query($sql)->getResultArray(); //run the query
    //     // print_r($data['showleavereason']); exit();
    //     return $data['showleavereason'];     
    // }

    public function selectleaveReasonM()
    {
        $sql = "SELECT * FROM `leavereason` ";
        $data['selectleavereason'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['selectleavereason']); exit();
        return $data['selectleavereason'];
    }

    public function getLeaveRequest($data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];
        $trickid = $data['trickid'];
        // print_r($trickid);exit;
        if ($trickid == 2) {
            $trick = "AND alr.leaveStatus = 1";    //Approved
        } elseif ($trickid == 3) {
            $trick = "AND alr.leaveStatus = 2";    //Rejected
        } elseif ($trickid == 4) {
            $trick = "AND alr.leaveStatus = 0";   //pending
        } elseif ($trickid == 1) {
            $trick = " ";
        }

        $sql = "SELECT alr.`IDPK`, mb.Mail_IDPK, lr.LeaveReason,e.Image, e.EmployeeCode,e.EmployeeName, alr.absentDate, mb.Mail_Msg AS Reason,  alr.leaveStatus, alr.createdAt,mb.readStatus FROM `absents_leave_request` alr
                LEFT JOIN `leavereason` lr ON lr.IDPK = alr.leaveReasonIDFK
                LEFT JOIN employees e ON e.EmployeeId = alr.EmployeeIDFK
                LEFT JOIN mail_base mb ON mb.Mail_IDPK = alr.Mail_Base_IDFK
                WHERE DATE(alr.createdAt) BETWEEN '$fdate' AND '$todate' and mb.Mail_TypeId = 2 $trick 
                ORDER BY mb.created_at DESC";
        $data['leaveRequest'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['leaveRequest']); exit();
        return $data['leaveRequest'];
    }
    public function allLRCountM($data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];
        $sql = "SELECT COUNT(leaveStatus) as counts FROM absents_leave_request WHERE DATE(createdAt) BETWEEN '$fdate' AND '$todate' ";
        $data['allLrCount'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['allLrCount']); exit();
        return $data['allLrCount'];
    }
    public function approveLRCountM($data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];
        $sql = "SELECT COUNT(leaveStatus) as counts FROM absents_leave_request WHERE leaveStatus = 1 AND DATE(createdAt) BETWEEN '$fdate' AND '$todate'";
        $data['approveLrCount'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['approveLrCount']); exit();
        return $data['approveLrCount'];
    }
    public function rejectLRCountM($data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];
        $sql = "SELECT COUNT(leaveStatus) as counts FROM absents_leave_request WHERE leaveStatus = 2 AND DATE(createdAt) BETWEEN '$fdate' AND '$todate'";
        $data['rejectLrCount'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['rejectLrCount']); exit();
        return $data['rejectLrCount'];
    }
    public function pendingLRCountM($data)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];
        $sql = "SELECT COUNT(leaveStatus) as counts FROM absents_leave_request WHERE leaveStatus = 0 AND DATE(createdAt) BETWEEN '$fdate' AND '$todate' ";
        $data['pendingLrCount'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['pendingLrCount']); exit();
        return $data['pendingLrCount'];
    }

    public function getEmpLeaveRequest($id)
    { //remove id and add data
        $id = $id['mailId'];

        $sqlread = "UPDATE `mail_base` SET `readStatus`= 1 WHERE `Mail_IDPK`= $id";
        $this->db->query($sqlread);

        $sql = "SELECT alr.`IDPK`,mb.Mail_IDPK, lr.LeaveReason,e.Image, e.Email, e.EmployeeId ,e.EmployeeCode,e.EmployeeName,d.designations,alr.absentDate, mb.Mail_Msg as Reason,  alr.leaveStatus,mb.readStatus, alr.createdAt , F.EmployeeId as SenderId, G.EmployeeId as ReceiverId
                FROM `absents_leave_request` alr
                LEFT JOIN `leavereason` lr ON lr.IDPK = alr.leaveReasonIDFK
                LEFT JOIN employees e ON e.EmployeeId = alr.EmployeeIDFK 
                LEFT JOIN designation d ON d.IDPK = e.DesignationIDFK
                LEFT JOIN mail_base mb ON mb.Mail_IDPK = alr.Mail_Base_IDFK
                LEFT JOIN employees F ON F.EmployeeId = mb.SenderId
                LEFT JOIN employees G ON G.EmployeeId = mb.ReceiverId
                WHERE alr.Mail_Base_IDFK = $id  ";
        $data['empleaveRequest'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['empleaveRequest']); exit();
        return $data['empleaveRequest'];
    }

    public function getEmpLeaveReply($id)
    { //remove id and add data

        $id = $id['mailId'];
        $sql = "SELECT D.EmployeeId, D.EmployeeName, A.SenderId, D.EmployeeName as SenderName, A.ReceiverId, E.EmployeeName as ReceiverName , A.Mail_Reply_Msg,A.created_at
        FROM `mail_reply` A
        LEFT JOIN mail_base B ON B.Mail_IDPK = A.Mail_Base_IDFK 
        LEFT JOIN absents_leave_request C ON C.Mail_Base_IDFK = B.Mail_IDPK 
        LEFT JOIN employees D ON D.EmployeeId = A.SenderId
        LEFT JOIN employees E ON E.EmployeeId = A.ReceiverId
        WHERE C. IDPK = $id ORDER BY A.created_at ASC";
        $data['empleaveReply'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['empleaveReply']); exit();
        return $data['empleaveReply'];
    }


    public function mailEmpSelect($data)
    {
        $deptsid = $data['deptsid'];
        // print_r($deptsid);exit();
        if ($deptsid == 'all' || empty($deptsid)) {
            $depts = " ";
        } elseif ($deptsid >= 1) {
            $depts = "WHERE DepartmentId = $deptsid ";
        }

        $sql = "SELECT EmployeeName as Name, EmployeeId as Id, Email, DepartmentId FROM `employees` $depts ";
        $data['mailempselect'] = $this->db->query($sql)->getResultArray();
        // print_r($data['mailempselect']);exit();

        return $data['mailempselect'];
    }


    public function HR_sent_box($data, $hrId)
    {
        $fdate = $data['fdate'];
        $todate = $data['todate'];

        $sql = "SELECT mb.Mail_IDPK, mb.SenderId, e.EmployeeName as SenderName, ee.EmployeeName as ReceiverName, mb.Mail_Msg, mb.created_at FROM `mail_base` mb 
                LEFT JOIN employees e ON e.EmployeeId=mb.SenderId
                LEFT JOIN employees ee ON ee.EmployeeId = mb.ReceiverId
                WHERE mb.SenderId = $hrId and DATE(created_at) BETWEEN '$fdate' AND '$todate' 
                ORDER BY mb.created_at DESC";
        // $sql="SELECT mb.Mail_IDPK, mb.SenderId, e.EmployeeName as SenderName, e.EmployeeName as ReceiverName, mb.Mail_Msg, mb.created_at 
        // FROM `mail_base` mb 
        // LEFT JOIN employees e ON e.EmployeeId=mb.SenderId
        // LEFT JOIN employees ee ON ee.EmployeeId = mb.ReceiverId
        // LEFT JOIN mail_reply mr ON mr.Mail_Base_IDFK = mb.Mail_IDPK
        // WHERE mb.ReceiverId = $hrId or mr.SenderId= $hrId and DATE(mb.created_at) BETWEEN '$fdate' AND '$todate' 
        // GROUP BY mb.Mail_IDPK
        // ORDER BY mb.created_at DESC";
        $data['HRSentBox'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['HRSentBox']); exit();
        return $data['HRSentBox'];
    }
    public function HR_readsent_box($data, $hrId)
    {
        $mailId = $data['mailId'];

        $sql = "SELECT mb.Mail_IDPK, mb.SenderId, e.EmployeeName as SenderName, ee.EmployeeName as ReceiverName, mb.Mail_Msg, mb.created_at FROM `mail_base` mb 
                LEFT JOIN employees e ON e.EmployeeId=mb.SenderId
                LEFT JOIN employees ee ON ee.EmployeeId = mb.ReceiverId
                WHERE mb.SenderId = $hrId  AND mb.Mail_IDPK = $mailId 
                ORDER BY mb.created_at DESC";
        $data['HRSentBox'] = $this->db->query($sql)->getResultArray(); //run the query
        // print_r($data['HRSentBox']); exit();
        return $data['HRSentBox'];
    }

    public function getHRadminList()
    {
        // print_r($adminId);exit();
        $sql = "SELECT EmployeeId, EmployeeName FROM employees Where DesignationIDFK = 1 and Status= 'Working' ";
        $data['adminId'] = $this->db->query($sql)->getResultArray();
        // print_r($data['adminId']);exit();
        return $data['adminId'];
    }
    public function getHRList()
    {
        $sql = "SELECT EmployeeId, EmployeeName FROM employees Where (DesignationIDFK = 18 or DesignationIDFK = 24 or DesignationIDFK = 1) and Status= 'Working' ";
        $data['HRList'] = $this->db->query($sql)->getResultArray();
        // print_r($data['HRList']);exit();
        return $data['HRList'];
    }

    public function getEmployee($id)
    {
        $sql = "SELECT B.designations, C.EmployeeTypeName, A.Image, A.EmployeeId, A.EmployeeName, A.EmployeeCode, A.Status, A.Gender, A.DOB, A.BLOODGROUP,
                       A.FatherName, A.MotherName, A.PlaceOfBirth, A.ResidentialAddress, A.PermanentAddress, A.ContactNo, A.AltContactno, A.EContactNo,
                       A.Email, A.PersonalMail, A.Salary_date, D.EmployeeName as ReportingPerson, E.designations as ReportingDesignation
                FROM `employees` A
                LEFT JOIN `designation` B ON B.IDPK = A.DesignationIDFK
                LEFT JOIN employement_type C ON C.IDPK= A.EmployementType
                LEFT JOIN `employees` D ON D.EmployeeId = A.ReportManagerIDFK
                LEFT JOIN `designation` E ON E.IDPK = D.DesignationIDFK
                WHERE A.EmployeeId = $id";

        $data['Employee'] = $this->db->query($sql)->getRowArray();
        return $data['Employee'];
    }

    public function getEmployeeWorkDetails($id)
    {
        $sql = "SELECT A.DOJ, B.deptName, A.UAN_No, A.PAN_No, A.Aadhar_No, A.ContractPeriod, C.EmployeeName
                FROM `employees` A
                LEFT JOIN `departments` B ON B.IDPK = A.DepartmentId
                LEFT JOIN `employees` C ON C.EmployeeId = A.ReportManagerIDFK
                WHERE A.EmployeeId = $id";
        $data['Employement'] = $this->db->query($sql)->getRowArray();

        $sql = "SELECT AccountHolderName, BankName, AccountNo, IFSCode, BankBranch, Type, Mode
                FROM `emp_bank_details`
                WHERE EmployeeIDFK = $id AND Type = 1";
        $data['Official'] = $this->db->query($sql)->getRowArray();

        $sql = "SELECT AccountHolderName, BankName, AccountNo, IFSCode, BankBranch, Type, Mode
                FROM `emp_bank_details`
                WHERE EmployeeIDFK = $id AND Type = 2";
        $data['Personal'] = $this->db->query($sql)->getRowArray();

        $sql = "SELECT * FROM `salary_info` WHERE EmployeeIDFK = $id ORDER BY `Updated_on` DESC LIMIT 1";
        $data['Salary'] = $this->db->query($sql)->getRowArray();

        return $data;
    }

    public function getEmployeeApprovals() {}

    public function getEmployeeAttendence() {}

    public function getEmployeeLateEntry($id, $date_start, $date_end)
    {
        $sql = "SELECT EmployeeCode FROM employees WHERE EmployeeId = $id";
        $data = $this->db->query($sql)->getRowArray();
        $EmployeeCode = $data['EmployeeCode'];
        // $EmployeeCode = 'H247OFF76';
        $date_start .= " 00:00:00";
        $date_end .= " 23:59:59";

        $sql = "SELECT * FROM (SELECT UserId, DATE(LogDate) AS LogDateDay, MIN(LogDate) AS FirstLogDate 
                          FROM devicelogs_processed 
                          WHERE UserId = '$EmployeeCode'
                          AND LogDate BETWEEN '$date_start' AND '$date_end'
                          GROUP BY DATE(LogDate)
                          ORDER BY LogDateDay ASC) AS SubQuery
                WHERE TIME(FirstLogDate) > '09:45:00'";

        $data = $this->bio->query($sql)->getResultArray();
        return $data;
    }

    public function getEmployeeTimeLogs($id, $date_start, $date_end)
    {
        $date_start = '2022-09-02';
        $date_end = '2022-09-15';

        // $sql = "SELECT B.LogDate, Late_Login, Early_Logout
        //             CASE 
        //                 WHEN TIME(B.LogDate) > '09:45:00' THEN 1
        //                 ELSE 0
        //             END AS Late_Login,
        //             CASE 
        //                 WHEN TIME(B.LogDate) < '18:30:00' THEN 1
        //                 ELSE 0
        //             END AS Early_Logout
        //         FROM homes247_backend.employees A 
        //         LEFT JOIN biomatric.devicelogs_processed B ON B.UserId = A.EmployeeCode 
        //         WHERE A.EmployeeId = $id AND DATE(B.LogDate) BETWEEN '$date_start' AND '$date_end'
        //         ORDER BY B.LogDate";

        $sql = "SELECT 
                    MIN(B.LogDate) AS LogDate, -- Get the earliest record for each HH:MM
                    (CASE 
                        WHEN TIME(MIN(B.LogDate)) > '09:45:00' THEN 1
                        ELSE 0
                    END) AS Late_Login,
                    (CASE 
                        WHEN TIME(MIN(B.LogDate)) < '18:30:00' THEN 1
                        ELSE 0
                    END) AS Early_Logout
                FROM homes247_backend.employees A 
                LEFT JOIN biometric.devicelogs_processed B ON B.UserId = A.EmployeeCode 
                WHERE A.EmployeeId = $id AND DATE(B.LogDate) BETWEEN '$date_start' AND '$date_end'
                GROUP BY DATE_FORMAT(B.LogDate, '%Y-%m-%d %H:%i') -- Group by date and time to the minute
                ORDER BY LogDate";
        $data = $this->bio->query($sql)->getResultArray();

        $groupedData = [];
        foreach ($data as $row) {
            $date = date('Y-m-d', strtotime($row['LogDate']));
            $groupedData[$date][] = [
                'LogDate' => $row['LogDate'],
                'Late_Login' => $row['Late_Login'],
                'Early_Logout' => $row['Early_Logout'],
                'LogTime' => date('H:i:s', strtotime($row['LogDate'])),
                'Day' => strtoupper(date('D', strtotime($row['LogDate']))),
                'd' => date('d', strtotime($row['LogDate']))
            ];
        }

        $points = [];
        foreach ($groupedData as $date => $group) {
            foreach ($group as $i => $g) {
                if (count($group) == 1) {
                    if ($g['LogTime'] < '09:45:00') {
                        $points[$date][] = ['time' => '09:45:00', 'auto' => 0, 'real' => $g['LogTime']];
                        $points[$date][] = ['time' => '18:30:00', 'auto' => 1, 'real' => $g['LogTime']];
                    } else if ($g['LogTime'] > '18:30:00') {
                        $points[$date][] = ['time' => '09:45:00', 'auto' => 1, 'real' => $g['LogTime']];
                        $points[$date][] = ['time' => '18:30:00', 'auto' => 0, 'real' => $g['LogTime']];
                    } else {
                        $points[$date][] = ['time' => $g['LogTime'], 'auto' => 0, 'real' => $g['LogTime']];
                        $points[$date][] = ['time' => '18:30:00', 'auto' => 1, 'real' => $g['LogTime']];
                    }
                } else {
                    if (count($group) - 1 == $i) {
                        if ($g['LogTime'] > '18:30:00') {
                            $points[$date][] = ['time' => '18:30:00', 'auto' => 0, 'real' => $g['LogTime']];
                        } else {
                            $points[$date][] = ['time' => $g['LogTime'], 'auto' => 0, 'real' => $g['LogTime']];
                            $points[$date][] = ['time' => '18:30:00', 'auto' => 1, 'real' => $g['LogTime']];
                        }
                    } else if ($i == 0) {
                        if ($g['LogTime'] < '09:45:00') {
                            $points[$date][] = ['time' => '09:45:00', 'auto' => 0, 'real' => $g['LogTime']];
                        } else {
                            $points[$date][] = ['time' => '09:45:00', 'auto' => 1, 'real' => $g['LogTime']];
                            $points[$date][] = ['time' => $g['LogTime'], 'auto' => 0, 'real' => $g['LogTime']];
                        }
                    } else {
                        $points[$date][] = ['time' => $g['LogTime'], 'auto' => 0, 'real' => $g['LogTime']];
                    }
                }
            }
        }

        $pointgroup = [];
        foreach ($points as $date => $point) {
            for ($i = 0; $i < count($point) - 1; $i++) {
                $pointgroup[$date][] = $this->point_distence($point[$i]['time'], $point[$i]['auto'], $point[$i + 1]['time'], $point[$i + 1]['auto']);
            }
        }

        echo '<pre>';
        print_r($pointgroup);
        echo '</pre>';
        exit(0);


        return $groupedData;
    }

    public function point_distence($start, $sa, $end, $ea)
    {
        $s = new DateTime($start);
        $e = new DateTime($end);
        $diff = $s->diff($e);
        $Mins = ($diff->h * 60) + ($diff->i);
        return array(
            'percentage' => round($Mins / 5.25),
            'start' => date('h:i A', strtotime($start)),
            'end' => date('h:i A', strtotime($end)),
            's_auto' => $sa,
            'e_auto' => $ea,
            'color' => ($sa == $ea) ? 1 : 0,
        );
    }

    public function getEmployeePaySlip($id, $month)
    {
        if ($month != "" || !empty($month) || $month != null) {
            $month = "AND MONTH(Updated_on) = MONTH('$month') AND YEAR(Updated_on) = YEAR('$month')";
        } else {
            $month = "";
        }
        $sql = "SELECT * FROM salary_info WHERE EmployeeIDFK = $id $month";
        $data = $this->db->query($sql)->getResultArray();
        // print_r($data);exit(0);
        return $data;
    }

    public function getEmployeePaySlipSpecific($id)
    {
        $sql = "(SELECT A.BasicSalary, A.HRA, A.FBP, A.PF, A.PT, A.PF_VOL, A.Spl_Ded, A.PF_NO, A.ESI_NO, A.NOD, A.MOP, A.Absent_Days, A.Credited_Salary,
                        B.DOJ, B.EmployeeCode, B.EmployeeName, C.designations, D.deptName, E.UAN_No, E.PAN_No, E.AccountNo, A.Updated_on
                FROM salary_info A
                LEFT JOIN `employees` B ON B.EmployeeId = A.EmployeeIDFK
                LEFT JOIN `designation` C ON C.IDPK = B.DesignationIDFK
                LEFT JOIN `departments` D ON D.IDPK = B.DepartmentId
                LEFT JOIN `emp_bank_details` E ON E.EmployeeIDFK = A.EmployeeIDFK
                WHERE E.Type = 1 AND A.IDPK = $id) 
                UNION
                (SELECT A.BasicSalary, A.HRA, A.FBP, A.PF, A.PT, A.PF_VOL, A.Spl_Ded, A.PF_NO, A.ESI_NO, A.NOD, A.MOP, A.Absent_Days, A.Credited_Salary,
                        B.DOJ, B.EmployeeCode, B.EmployeeName, C.designations, D.deptName, E.UAN_No, E.PAN_No, E.AccountNo, A.Updated_on
                FROM salary_info A
                LEFT JOIN `employees` B ON B.EmployeeId = A.EmployeeIDFK
                LEFT JOIN `designation` C ON C.IDPK = B.DesignationIDFK
                LEFT JOIN `departments` D ON D.IDPK = B.DepartmentId
                LEFT JOIN `emp_bank_details` E ON E.EmployeeIDFK = A.EmployeeIDFK
                WHERE E.Type = 2 AND A.IDPK = $id 
                AND NOT EXISTS (SELECT 1 FROM `emp_bank_details` WHERE EmployeeIDFK = A.EmployeeIDFK AND Type = 1))";
        $data = $this->db->query($sql)->getRowArray();
        // print_r($data);exit(0);
        return $data;
    }

    public function getEmployeeFiles($id)
    {
        $sql = "SELECT IDPK, Doc_CategoryIDFK, Document_Name FROM documents WHERE EmployeeIDFK = $id";
        $data = $this->db->query($sql)->getResultArray();
        // print_r($data);exit(0);
        return $data;
    }

    public function getEmployeeProFilesStore($data)
    {
        foreach ($data as $record) {
            $EmployeeIDFK = $record['EmployeeIDFK'];
            $Doc_CategoryIDFK = $record['Doc_CategoryIDFK'];
            $Document_Name = $record['Document_Name'];
            $sql = "INSERT INTO documents(`EmployeeIDFK`, `Doc_CategoryIDFK`, `Document_Name`) VALUES('$EmployeeIDFK', '$Doc_CategoryIDFK', '$Document_Name')";
            $this->db->query($sql);
        }
    }

    public function getEmployeeProFilesRemove($id, $path)
    {
        $sql = "SELECT Document_Name FROM documents WHERE IDPK = $id";
        $name = $this->db->query($sql)->getRowArray();
        $filePath = $path . $name['Document_Name']; // Path to the file you want to delete
        if (file_exists($filePath)) {
            unlink($filePath); // Delete the file
        } else {
            echo "File not found.";
        }
        $sql = "DELETE FROM documents WHERE IDPK = $id";
        $this->db->query($sql);
        // print_r($filePath);exit(0);
        return $name;
    }

    public function UpdateSingleEmployee($id, $data, $acctype)
    {
        // Ensure $data is not empty
        if (empty($data)) {
            return false; // No data to update
        }

        // Construct the SET clause dynamically
        foreach ($data as $key => $value) {
            $setClause = "`$key` = '" . $value . "'";
            $column = $key;
        }

        // Construct the SQL query
        $employee_table = ["ReportManagerIDFK", "Salary_date","ContractPeriod","Aadhar_No", "PAN_No", "UAN_No", "EContactNo"];
        $salary_info = ["BasicSalary", "HRA", "FBP", "PF", "PT", "PF_VOL", "Insurance", "SD", "GrossSalary", "NetSalary"];
        $emp_bank_table = ["AccountHolderName", "BankName", "BankBranch", "AccountNo", "IFSCode", "Mode"];
        $bio_employee_table = ["EmployeeName", "EmployeeCode", "Gender", "DOB", "BLOODGROUP", "FatherName", "MotherName", "PlaceOfBirth", "ResidentialAddress", "PermanentAddress", "ContactNo", "AltContactno", "Email", "PersonalMail", "DepartmentId", "DesignationIDFK", "Status", "EmployementType", "DOJ", "Image"];

        if (in_array($column, $bio_employee_table)) {
            $sql1 = "UPDATE biometric.employees SET $setClause WHERE `EmployeeId` = ?";
            $sql2 = "UPDATE `employees` SET $setClause WHERE `EmployeeId` = ?";
            $this->db->query($sql1, $id);
            $this->db->query($sql2, $id);
        } else if (in_array($column, $employee_table)) {
            $sql3 = "UPDATE `employees` SET $setClause WHERE `EmployeeId` = ?";
            $this->db->query($sql3, $id);
        } else if (in_array($column, $salary_info)) {
            $sql4 = "UPDATE `salary_info` SET $setClause WHERE `EmployeeIDFK` = ?";
            $this->db->query($sql4, $id);
        } else if (in_array($column, $emp_bank_table)) {
            $sql5 = "UPDATE `emp_bank_details` SET $setClause WHERE `EmployeeIDFK`=? AND `Type`= $acctype";
            $this->db->query($sql5, $id);
        }
        return true;
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Department::truncate();

        Department::create([
            'PK_warehouse' => 1000,
            'name' => 'ZCMC_CIIS',
            'abbreviation' => "CIIS",
        ]);
        
        Department::create([
            'PK_warehouse' => 1001,
            'name' => 'Cardiovascular',
            'abbreviation' => "Cardiovascular",
        ]);
        
        Department::create([
            'PK_warehouse' => 1002,
            'name' => 'Accounting',
            'abbreviation' => "Accounting",
        ]);
        
        Department::create([
            'PK_warehouse' => 1003,
            'name' => 'Admitting',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1004,
            'name' => 'Anesthesia Department',
            'abbreviation' => "Anesthesia",
        ]);
        
        Department::create([
            'PK_warehouse' => 1005,
            'name' => 'Procurement Section',
            'abbreviation' => "Procurement Section",
        ]);
        
        Department::create([
            'PK_warehouse' => 1006,
            'name' => 'Bacteriology',
            'abbreviation' => "Bacteriology",
        ]);
        
        Department::create([
            'PK_warehouse' => 1007,
            'name' => 'Billing',
            'abbreviation' => "Billing",
        ]);
        
        Department::create([
            'PK_warehouse' => 1008,
            'name' => 'Biomed',
            'abbreviation' => "Biomed",
        ]);
        
        Department::create([
            'PK_warehouse' => 1009,
            'name' => 'Birthing Clinic',
            'abbreviation' => "Birthing Clinic",
        ]);
        
        Department::create([
            'PK_warehouse' => 1010,
            'name' => 'Blood Bank',
            'abbreviation' => "Blood Bank",
        ]);
        
        Department::create([
            'PK_warehouse' => 1011,
            'name' => 'Budget',
            'abbreviation' => "Budget",
        ]);
        
        Department::create([
            'PK_warehouse' => 1012,
            'name' => 'Cashier MAIN',
            'abbreviation' => "Cashier",
        ]);
        
        Department::create([
            'PK_warehouse' => 1013,
            'name' => 'Chief of Clinics',
            'abbreviation' => "Chief Clinics",
        ]);
        
        Department::create([
            'PK_warehouse' => 1014,
            'name' => 'Commission on Audit',
            'abbreviation' => "COA",
        ]);
        
        Department::create([
            'PK_warehouse' => 1015,
            'name' => 'Central Supply',
            'abbreviation' => "CSR",
        ]);
        
        Department::create([
            'PK_warehouse' => 1016,
            'name' => 'CT Scan',
            'abbreviation' => "Ct Scan",
        ]);
        
        Department::create([
            'PK_warehouse' => 1017,
            'name' => 'Delivery Room',
            'abbreviation' => "DR",
        ]);
        
        Department::create([
            'PK_warehouse' => 1018,
            'name' => 'Dental',
            'abbreviation' => "Dental",
        ]);
        
        Department::create([
            'PK_warehouse' => 1019,
            'name' => 'Dialysis',
            'abbreviation' => "Dialysis",
        ]);
        
        Department::create([
            'PK_warehouse' => 1020,
            'name' => 'Nutrition and Dietetics',
            'abbreviation' => "Dietary",
        ]);
        
        Department::create([
            'PK_warehouse' => 1021,
            'name' => 'Drug Testing',
            'abbreviation' => "Drug Testing",
        ]);
        
        Department::create([
            'PK_warehouse' => 1022,
            'name' => 'Emergency Room',
            'abbreviation' => "ER",
        ]);
        
        Department::create([
            'PK_warehouse' => 1023,
            'name' => 'Eye Center OPD',
            'abbreviation' => "Eye Center",
        ]);
        
        Department::create([
            'PK_warehouse' => 1024,
            'name' => 'Health Emergency Management Staff',
            'abbreviation' => "HEMS",
        ]);
        
        Department::create([
            'PK_warehouse' => 1025,
            'name' => 'Housekeeping',
            'abbreviation' => "Housekeeping",
        ]);
        
        Department::create([
            'PK_warehouse' => 1026,
            'name' => 'Medical Intesive Care Unit',
            'abbreviation' => "MICU",
        ]);
        
        Department::create([
            'PK_warehouse' => 1027,
            'name' => 'Infra',
            'abbreviation' => "Infra",
        ]);
        
        Department::create([
            'PK_warehouse' => 1028,
            'name' => 'Laboratory',
            'abbreviation' => "Lab",
        ]);
        
        Department::create([
            'PK_warehouse' => 1029,
            'name' => 'Laundry',
            'abbreviation' => "Laundry",
        ]);
        
        Department::create([
            'PK_warehouse' => 1030,
            'name' => 'Library',
            'abbreviation' => "Library",
        ]);
        
        Department::create([
            'PK_warehouse' => 1031,
            'name' => 'Engineering and Facility Management',
            'abbreviation' => "EFM",
        ]);
        
        Department::create([
            'PK_warehouse' => 1032,
            'name' => 'Medical Social Service',
            'abbreviation' => "MSS",
        ]);
        
        Department::create([
            'PK_warehouse' => 1033,
            'name' => 'Health Management Information Office',
            'abbreviation' => "Health Management Information",
        ]);
        
        Department::create([
            'PK_warehouse' => 1034,
            'name' => 'Management Information System/Information Tech',
            'abbreviation' => "MIS/IT",
        ]);
        
        Department::create([
            'PK_warehouse' => 1035,
            'name' => 'Neonatal Intesive Care Unit',
            'abbreviation' => "NICU",
        ]);
        
        Department::create([
            'PK_warehouse' => 1036,
            'name' => 'Nursing Office',
            'abbreviation' => "NSO",
        ]);
        
        Department::create([
            'PK_warehouse' => 1037,
            'name' => 'OPD Triage',
            'abbreviation' => "OPD Triage",
        ]);
        
        Department::create([
            'PK_warehouse' => 1038,
            'name' => 'Operating Room',
            'abbreviation' => "OR",
        ]);
        
        Department::create([
            'PK_warehouse' => 1039,
            'name' => 'Public Affairs and Customer Care Unit',
            'abbreviation' => "PACCU",
        ]);
        
        Department::create([
            'PK_warehouse' => 1040,
            'name' => 'Post Anesthesia Care Unit (PACU)',
            'abbreviation' => "PACU",
        ]);
        
        Department::create([
            'PK_warehouse' => 1041,
            'name' => 'Payroll',
            'abbreviation' => "Payroll",
        ]);
        
        Department::create([
            'PK_warehouse' => 1042,
            'name' => 'Personnel',
            'abbreviation' => "Personnel",
        ]);
        
        Department::create([
            'PK_warehouse' => 1043,
            'name' => 'Pharmacy',
            'abbreviation' => "Pharmacy",
        ]);
        
        Department::create([
            'PK_warehouse' => 1044,
            'name' => 'Philhealth',
            'abbreviation' => "PHIC",
        ]);
        
        Department::create([
            'PK_warehouse' => 1045,
            'name' => 'Powerhouse',
            'abbreviation' => "Powerhouse",
        ]);
        
        Department::create([
            'PK_warehouse' => 1046,
            'name' => 'PRCM',
            'abbreviation' => "PRCM",
        ]);
        
        Department::create([
            'PK_warehouse' => 1047,
            'name' => 'Public Health Unit',
            'abbreviation' => "PHU",
        ]);
        
        Department::create([
            'PK_warehouse' => 1048,
            'name' => 'Pulmonary',
            'abbreviation' => "Pulmonary",
        ]);
        
        Department::create([
            'PK_warehouse' => 1049,
            'name' => 'Radio Oncology',
            'abbreviation' => "Radio Oncology",
        ]);
        
        Department::create([
            'PK_warehouse' => 1050,
            'name' => 'Rehabilitation Center',
            'abbreviation' => "Rehab",
        ]);
        
        Department::create([
            'PK_warehouse' => 1051,
            'name' => 'Room 1 Medicine',
            'abbreviation' => "Room 1",
        ]);
        
        Department::create([
            'PK_warehouse' => 1052,
            'name' => 'Room 2 OB-Gyne',
            'abbreviation' => "Room 2",
        ]);
        
        Department::create([
            'PK_warehouse' => 1053,
            'name' => 'Room 3 Surgery',
            'abbreviation' => "Room 3",
        ]);
        
        Department::create([
            'PK_warehouse' => 1054,
            'name' => 'Room 6 Family Medicince',
            'abbreviation' => "Room 6",
        ]);
        
        Department::create([
            'PK_warehouse' => 1055,
            'name' => 'Senior Citizen Ward',
            'abbreviation' => "SCW",
        ]);
        
        Department::create([
            'PK_warehouse' => 1056,
            'name' => 'Supply',
            'abbreviation' => "Supply",
        ]);
        
        Department::create([
            'PK_warehouse' => 1057,
            'name' => 'PETRO',
            'abbreviation' => "PETRO",
        ]);
        
        Department::create([
            'PK_warehouse' => 1058,
            'name' => 'Ultrasound',
            'abbreviation' => "UTZ",
        ]);
        
        Department::create([
            'PK_warehouse' => 1059,
            'name' => 'Room 10 Under 5 Clinic',
            'abbreviation' => "Room 10",
        ]);
        
        Department::create([
            'PK_warehouse' => 1060,
            'name' => 'OB-Gyne (Ward 1)',
            'abbreviation' => "Ward 1",
        ]);
        
        Department::create([
            'PK_warehouse' => 1061,
            'name' => 'Orthopedics/Neuro Ward (Ward 2 & 3)',
            'abbreviation' => "Ward 2/3",
        ]);
        
        Department::create([
            'PK_warehouse' => 1062,
            'name' => 'Surgery Ward (Ward 4)',
            'abbreviation' => "Ward 4",
        ]);
        
        Department::create([
            'PK_warehouse' => 1063,
            'name' => 'Internal Medicine Ward (WARD 5)',
            'abbreviation' => "Ward 5",
        ]);
        
        Department::create([
            'PK_warehouse' => 1064,
            'name' => 'Infectious Ward (Ward 6)',
            'abbreviation' => "Ward 6",
        ]);
        
        Department::create([
            'PK_warehouse' => 1065,
            'name' => 'Pediatrics Ward (Ward8)',
            'abbreviation' => "Ward 8",
        ]);
        
        Department::create([
            'PK_warehouse' => 1066,
            'name' => 'Psychiatric Ward (Ward 9)',
            'abbreviation' => "Ward 9",
        ]);
        
        Department::create([
            'PK_warehouse' => 1067,
            'name' => 'X-ray',
            'abbreviation' => "X-ray",
        ]);
        
        Department::create([
            'PK_warehouse' => 1068,
            'name' => 'Heart Clinic',
            'abbreviation' => "Heart Clinic",
        ]);
        
        Department::create([
            'PK_warehouse' => 1069,
            'name' => 'ENT',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1070,
            'name' => 'Temp Station',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1071,
            'name' => 'Material Management Section',
            'abbreviation' => "Material Management Section",
        ]);
        
        Department::create([
            'PK_warehouse' => 1072,
            'name' => 'CMPS',
            'abbreviation' => "CMPS",
        ]);
        
        Department::create([
            'PK_warehouse' => 1073,
            'name' => 'PMDT',
            'abbreviation' => "PMDT",
        ]);
        
        Department::create([
            'PK_warehouse' => 1074,
            'name' => 'Internal Medicine Follow-up Clinic',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1075,
            'name' => 'Medical Center Chief Office',
            'abbreviation' => "MMCO",
        ]);
        
        Department::create([
            'PK_warehouse' => 1076,
            'name' => 'CAO Office',
            'abbreviation' => "CAO Office",
        ]);
        
        Department::create([
            'PK_warehouse' => 1077,
            'name' => 'Magnetic Resonance Imaging',
            'abbreviation' => "MRI",
        ]);
        
        Department::create([
            'PK_warehouse' => 1078,
            'name' => 'Human Milk Bank',
            'abbreviation' => "H.M.U.",
        ]);
        
        Department::create([
            'PK_warehouse' => 1079,
            'name' => 'Warehouse MEDICINES',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1080,
            'name' => 'Legal office',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1081,
            'name' => 'Central Supply & Sterilization Warehouse',
            'abbreviation' => "Central Supply & Sterilization",
        ]);
        
        Department::create([
            'PK_warehouse' => 1082,
            'name' => 'Internal Control Unit',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1083,
            'name' => 'Security',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1084,
            'name' => 'Human Resource Management Office',
            'abbreviation' => "HRMO",
        ]);
        
        Department::create([
            'PK_warehouse' => 1085,
            'name' => 'Surgery Department',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1086,
            'name' => 'Internal Medicine Department',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1087,
            'name' => 'WCPU',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1088,
            'name' => 'TB-DOTS',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1089,
            'name' => 'Ophthalmology Department',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1090,
            'name' => 'OB-Gyne Operating Room',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1091,
            'name' => 'Injection Room',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1092,
            'name' => 'Ward 1',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1093,
            'name' => 'Ward 2',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1094,
            'name' => 'Ward 4',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1095,
            'name' => 'Ward 5',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1096,
            'name' => 'Communicable Ward (Ward 7)',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1096,
            'name' => 'Ward 8',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1097,
            'name' => 'Ward 9',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1099,
            'name' => 'Document Control Office',
            'abbreviation' => "Document Control Office",
        ]);
        
        Department::create([
            'PK_warehouse' => 1100,
            'name' => 'SICU',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1101,
            'name' => 'Infection Prevention and Control Committee',
            'abbreviation' => "IPCC",
        ]);
        
        Department::create([
            'PK_warehouse' => 1102,
            'name' => 'Pharmacy STOP DEATH',
            'abbreviation' => "Pharmacy STOP DEATH",
        ]);
        
        Department::create([
            'PK_warehouse' => 1103,
            'name' => 'Pharmacy OPD',
            'abbreviation' => "Pharmacy OPD",
        ]);
        
        Department::create([
            'PK_warehouse' => 1104,
            'name' => 'Family Planning',
            'abbreviation' => "Family Planning",
        ]);
        
        Department::create([
            'PK_warehouse' => 1105,
            'name' => 'Research Unit',
            'abbreviation' => "Research Unit",
        ]);
        
        Department::create([
            'PK_warehouse' => 1106,
            'name' => 'Treatment Hub',
            'abbreviation' => "Treatment Hub",
        ]);
        
        Department::create([
            'PK_warehouse' => 1107,
            'name' => 'Milk Bank (Deactivated)',
            'abbreviation' => "Milk Bank (Deactivated)",
        ]);
        
        Department::create([
            'PK_warehouse' => 1108,
            'name' => 'Nuclear Medicine Department',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1109,
            'name' => 'Planning Department',
            'abbreviation' => "Planning",
        ]);
        
        Department::create([
            'PK_warehouse' => 1110,
            'name' => 'Finance Department',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1111,
            'name' => 'Pediatric Intensive Care Unit (PICU)',
            'abbreviation' => "PICU",
        ]);
        
        Department::create([
            'PK_warehouse' => 1112,
            'name' => 'OB-Gyne Department',
            'abbreviation' => "OB-GYNE Conference",
        ]);
        
        Department::create([
            'PK_warehouse' => 1113,
            'name' => 'OB-GYNE PACU',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1114,
            'name' => 'OPD Chief Office',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1115,
            'name' => 'PHARMACY ARMM',
            'abbreviation' => "PHARMACY ARMM",
        ]);
        
        Department::create([
            'PK_warehouse' => 1116,
            'name' => 'PHARMACY (Emergency Medicines)',
            'abbreviation' => "PHARMACY (Emergency Medicines)",
        ]);
        
        Department::create([
            'PK_warehouse' => 1117,
            'name' => 'Cancer Center',
            'abbreviation' => "Cancer Center",
        ]);
        
        Department::create([
            'PK_warehouse' => 1118,
            'name' => 'Nutrition and Dietetics Warehouse',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1119,
            'name' => 'Eye Center Ward',
            'abbreviation' => "EYE CENTER WARD",
        ]);
        
        Department::create([
            'PK_warehouse' => 1120,
            'name' => 'Peritonial Dialysis Unit',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1121,
            'name' => 'Endoscopy Unit',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1122,
            'name' => 'Central Supply OPD',
            'abbreviation' => "CSR",
        ]);
        
        Department::create([
            'PK_warehouse' => 1123,
            'name' => 'Warehouse Medicines (ARMM)',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1124,
            'name' => 'Patient Safety Office',
            'abbreviation' => "PATIENT SAFETY OFFICE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1125,
            'name' => 'COVID OPD Building',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1126,
            'name' => 'COVID ER - ISO',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1127,
            'name' => 'COVID Surgery Building',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1128,
            'name' => 'COVID Pedia Building',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1129,
            'name' => 'COVID Ward 5 Building',
            'abbreviation' => "COVID WARD5 BUILDING",
        ]);
        
        Department::create([
            'PK_warehouse' => 1130,
            'name' => 'COVID Ward 9 Building',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1131,
            'name' => 'PPE-RMT',
            'abbreviation' => "PPE-RMT",
        ]);
        
        Department::create([
            'PK_warehouse' => 1132,
            'name' => 'COVID CIU-Stepdown Cabatangan',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1133,
            'name' => 'COVID Dialysis',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1134,
            'name' => 'WARD 1 HOLDING AREA',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1135,
            'name' => 'Ward 5 Infectious',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1136,
            'name' => 'Ward 4 Infectious',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1137,
            'name' => 'Ward 8 Infectious',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1138,
            'name' => 'Office for Institutional Strategy and Excellence',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1139,
            'name' => 'Medical Oxygen',
            'abbreviation' => "Medical Oxygen",
        ]);
        
        Department::create([
            'PK_warehouse' => 1140,
            'name' => 'Medical Oxygen Gas Plant',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1140,
            'name' => 'Medical Oxygen Gas Plant',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1141,
            'name' => 'COVID Triage',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1142,
            'name' => 'COVID Pre-Triage',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1143,
            'name' => 'WARD 2 Holding Area',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1144,
            'name' => 'IM Transition Area',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1145,
            'name' => 'PPE-RMT WAREHOUSE',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1146,
            'name' => 'PoIson Control Center',
            'abbreviation' => "PCC",
        ]);
        
        Department::create([
            'PK_warehouse' => 1147,
            'name' => 'Integrated Hospital Operations Management Program',
            'abbreviation' => "IHOMP",
        ]);
        
        Department::create([
            'PK_warehouse' => 1148,
            'name' => 'Cashier Collecting',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1149,
            'name' => 'DOH Warehouse',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1150,
            'name' => 'CSSD/MEDICINE DISPOSAL',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1151,
            'name' => 'Pediatrics Department',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1152,
            'name' => 'Gyne Oncology',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1153,
            'name' => 'Chemotherapy Unit',
            'abbreviation' => "Chemo Unit",
        ]);
        
        Department::create([
            'PK_warehouse' => 1154,
            'name' => 'HOSPITAL PATIENT SAFETY COMMITTEE',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1155,
            'name' => 'EYE CENTER PACU',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1156,
            'name' => 'CLAIMS MEDICAL UNIT',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1157,
            'name' => 'RADIOLOGY DEPARMENT',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1158,
            'name' => 'ISOLATION BUILDING',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1159,
            'name' => 'Committee on ARTA',
            'abbreviation' => "NONE",
        ]);
        
        Department::create([
            'PK_warehouse' => 1160,
            'name' => 'DONATIONS',
            'abbreviation' => "NONE",
        ]);
        
        
        Department::create([
            'PK_warehouse' => 1161,
            'name' => 'Office of Medical Center Chief',
            'abbreviation' => "OMCC",
        ]);
    }
}

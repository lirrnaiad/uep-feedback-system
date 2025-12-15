import './bootstrap';

// Services data derived from services.pdf (Citizen's Charter 2025, 1st Edition)
const servicesData = {
    campuses: [
        {
            campus_name: 'UEP Main Campus (Catarman)',
            offices: [
                {
                    office_name: 'Office of the University President',
                    services: {
                        external: [
                            'Receiving, Approval and Releasing of Documents',
                            'Memorandum Signing of Agreement, Memorandum of Understanding, Licensing Agreement, Research Contracts, and Deed of Donation',
                        ],
                        internal: [
                            'Approval of Travel Orders (Official Business and Office Time)',
                            'Receiving, Approval and Releasing of Documents',
                        ],
                    },
                },
                {
                    office_name: 'Bids and Awards Committee Office',
                    services: {
                        external: ['Procurement Process'],
                        internal: ['Procurement Process'],
                    },
                },
                {
                    office_name: 'Office of the Information and Communications Technology',
                    services: {
                        external: [
                            'Request for CCTV Review and Data Back-up',
                            'Request for Printing of Data',
                        ],
                        internal: [
                            'Request for Biometrics Access',
                            'Request for Biometrics Access Suspension',
                            'Request for CCTV Review and Data Back-up',
                            'Request for ICT Services',
                            'Request for Printing of Data',
                            'Request for the Theater Hall Use',
                            'Request for Transfer of Load',
                            'Request for Withdrawal / Cancellation of Enrolment for Current Semester',
                            'Request for Withdrawal of Load / Subjects',
                        ],
                    },
                },
                {
                    office_name: 'Internal Audit Services Office',
                    services: {
                        external: [],
                        internal: [
                            'Audit of Disbursement Vouchers for Basic Salary, PERA, and First Salary of Newly Hired Employees (NHE)',
                            'Audit of Disbursement Vouchers for Cash Advance for Approved Travel Orders',
                            'Audit of Disbursement Vouchers for Maternity Leave of Absence',
                            'Audit of Disbursement Vouchers for Other Claims',
                            'Audit of Disbursement Vouchers for Payroll',
                            'Receipt of Special Orders, Memoranda, Communication, and others',
                        ],
                    },
                },
                {
                    office_name: 'National Service Training Program',
                    services: {
                        external: [],
                        internal: [
                            'Application for Graduation / Clearance',
                            'Registration of NSTP Trainees',
                            'Request for Issuance of Serial Numbers',
                            'Request for NSTP Certification',
                        ],
                    },
                },
                {
                    office_name: 'Office of Student Affairs',
                    services: {
                        external: [
                            'New Normal/Adjunct Process',
                            'Request for Counselling Session (Walk-In)',
                            'Request for Performance',
                            'Testing Services',
                        ],
                        internal: [
                            'Accreditation and Re-accreditation of Campus Student Organization',
                            'Availment of Insurance Benefit Procedures',
                            'Issuance of Certification of No-Scholarship',
                            'New Normal/Adjunct Process',
                            'Request for Counselling Session (Referred)',
                            'Request for Counselling Session (Walk-In)',
                            'Request for Performance',
                        ],
                    },
                },
                {
                    office_name: 'University Publication and Media Affairs Office',
                    services: {
                        external: [],
                        internal: ['University Publication and Coverage Services'],
                    },
                },
                {
                    office_name: 'Office of the Vice President for Academic Affairs',
                    services: {
                        external: [],
                        internal: [
                            'Request for Curriculum Review/Offering',
                            'Request for Offering of Subject',
                            'Request for Outsourcing of Lecturers',
                            'Request for Recommendation of Documents for Student Internship of the Philippines Program (SIPP) and Local Off-Campus Activities',
                        ],
                    },
                },
                {
                    office_name: 'College of Agriculture, Fisheries and Natural Resources',
                    services: {
                        external: ['Request for Letter of Recommendation for Job Employment'],
                        internal: [
                            'Re-issuance of Certificate of Registration',
                            'Evaluation/Report of Grades',
                            'Request for Subject Offerings',
                            'Request for Letter of Recommendation for Job Employment',
                        ],
                    },
                },
                {
                    office_name: 'College of Arts and Communication',
                    services: {
                        external: ['Request for Letter of Recommendation for Job Employment'],
                        internal: [
                            'Re-issuance of Certificate of Registration (COR)',
                            'Evaluation of Grades',
                            'Request for Subject Offerings',
                            'Request for Letter of Recommendation for Job Employment',
                        ],
                    },
                },
                {
                    office_name: 'College of Criminal Justice',
                    services: {
                        external: ['Request for Recommendation for Job Employment'],
                        internal: [
                            'Re-issuance of Certificate of Registration',
                            'Request for Copies of Evaluation of Grades / Report of Grades',
                            'Request for Subject Offerings',
                            'Request for Recommendation for Job Employment',
                        ],
                    },
                },
                {
                    office_name: 'College of Education',
                    services: {
                        external: ['Request for Recommendation'],
                        internal: [
                            'Request for Reprinting of Certificate of Registration (COR)',
                            'Request for Copies of Evaluation of Grades / Report of Grades',
                            'Approval of Request for Subject Offering',
                            'Request for Recommendation Letter',
                        ],
                    },
                },
                {
                    office_name: 'UEP Kiddie Learning Center',
                    services: {
                        external: ['Enrolment of New/Old Pupils'],
                        internal: ['Enrolment of New/Old Pupils', 'Order of Payment'],
                    },
                },
                {
                    office_name: 'UEP Laboratory Elementary School',
                    services: {
                        external: [
                            'Admission of New Pupils and Transferees',
                            'Enrolment of New Pupils and Transferees',
                            'Request for Form 137',
                            'Issuance of Certification of Loyalty',
                        ],
                        internal: [
                            'Enrolment of Continuing Students',
                            'Request for Form 137',
                            'Issuance of Certification of Loyalty',
                        ],
                    },
                },
                {
                    office_name: 'UEP Laboratory High School',
                    services: {
                        external: [
                            'Issuance of Form 137/ Permanent Record',
                            'Admission of Incoming Grade 7',
                        ],
                        internal: [
                            'Issuance of Form 137/ Permanent Record',
                            'Admission of Incoming Grade 7',
                            'Enrolment',
                            'Request for Certificate of Enrolment',
                        ],
                    },
                },
                {
                    office_name: 'College of Engineering',
                    services: {
                        external: ['Request for Expert Services'],
                        internal: [
                            'Request for Reprinting of COR',
                            'Request for Copies of the Evaluation of Grades / Report of Grades',
                            'Request for Subject/Course Offering',
                        ],
                    },
                },
                {
                    office_name: 'College of Law',
                    services: {
                        external: [
                            'Request for Certificate of No Derogatory Record/ Joint Testimonial of Good Moral Character',
                        ],
                        internal: [
                            'Request for Reprinting of Certificate of Registration (COR)',
                            'Request for Certificate of No Derogatory Record/ Joint Testimonial of Good Moral Character',
                            'Request for Copies of Evaluation of Grades/Report of Grades',
                        ],
                    },
                },
                {
                    office_name: 'College of Nursing and Allied Health Sciences',
                    services: {
                        external: ['Request for Surgical and Medical Mission Services'],
                        internal: ['Request for Reprinting of Certificate of Registration (COR)'],
                    },
                },
                {
                    office_name: 'College of Science',
                    services: {
                        external: ['Request for Recommendation Letter'],
                        internal: [
                            'Re-issuance of Certificate of Registration (COR)',
                            'Evaluation of Grades/Report of Grades',
                            'Request for Subject Offering',
                            'Request for Recommendation Letter',
                        ],
                    },
                },
                {
                    office_name: 'College of Veterinary Medicine',
                    services: {
                        external: [
                            'Request for Rabies Vaccination of Dogs and Cats at the Veterinary Teaching Hospital Through the UEP- CVM Extension Office',
                            'Request for Necropsy Summary Report',
                            'Request for Mortality Report',
                        ],
                        internal: [
                            'Request for Reprinting of Certificate of Registration (COR)',
                            'Request for Copies of Evaluation of Grades/Report of Grades',
                        ],
                    },
                },
                {
                    office_name: 'Expanded Tertiary Education and Equivalency Accreditation Program',
                    services: {
                        external: ['Application for a Degree through ETEEAP'],
                        internal: [],
                    },
                },
                {
                    office_name: 'Graduate Studies',
                    services: {
                        external: ['Enrolment of New Students'],
                        internal: [
                            'Enrolment of Continuing Students',
                            'Request for Administration of Comprehensive Examinations',
                            'Request for Administration of Qualifying Examinations',
                            'Request for the Approval of Title and Pre-Oral and Final Examination/ Defense of Thesis/Dissertation',
                        ],
                    },
                },
                {
                    office_name: 'Office of the Director for Admission (ODA)',
                    services: {
                        external: [
                            'Application for Incoming Freshmen',
                            'Application for Transfer',
                        ],
                        internal: ['Application for Re-Admission and Shift to Other Course'],
                    },
                },
                {
                    office_name: 'Office of the Director for Instruction',
                    services: {
                        external: ['Request of Documents'],
                        internal: [
                            'Review of Faculty Actual Workload Form and Faculty Workload Computation',
                            'Students Evaluation of Faculty Teaching Performance',
                            'Review of SIPP and Local-Off Campus Documentary Requirements',
                            'Request of Documents',
                        ],
                    },
                },
                {
                    office_name: 'Office of the Registrar',
                    services: {
                        external: [
                            'Application and Receiving of Application for Graduation',
                            'Request for Authentication of Academic Records',
                            'Request for Certification of Academic Records',
                            'Request for Certification Authentication and Verification (CAV)',
                            'Request for Change, Edit of Erroneous Encoded Grades',
                            'Request for Change for Authentication of Grades, COR, ID and ID Validation',
                            'Request for Change of Civil Status',
                            'Request for Honorable Dismissal',
                            'Request for the Issuance of Certificate of Good Moral Character (CGMC)',
                            'Request for Issuance of Diploma',
                            'Request for the Issuance of Graduate Studies and Juris Doctor Transcript of Records',
                            'Request for the Issuance of Subsequent Diploma',
                            'Request for the Issuance of Subsequent Transcript of Records',
                            'Request for the Issuance of Subsequent Transcript of Records for Graduate Studies and Juris Doctor',
                            'Request for the Issuance of Transcript of Records',
                            'Request for Online Academic Record Verification',
                            'Request for Related Learning Experience (RLE) for Abroad',
                        ],
                        internal: [],
                    },
                },
                {
                    office_name: 'University Library Services',
                    services: {
                        external: [],
                        internal: [
                            'Borrowing of Books',
                            'Circulation Services',
                            'Library Orientation/Instruction',
                            'Reference Service',
                        ],
                    },
                },
                {
                    office_name: 'Office of the Vice President for Administration and Finance',
                    services: {
                        external: ['Endorsement of Memorandum of Agreements (MOA)'],
                        internal: ['Endorsement of Memorandum of Agreements (MOA)'],
                    },
                },
                {
                    office_name: 'Accounting Office',
                    services: {
                        external: [
                            'Issuance of Order of Payment',
                            'Issuance of Student Statement of Account',
                            'Payment thru Advice to Debit Account (ADA)',
                            'Processing of Disbursement Vouchers',
                        ],
                        internal: [],
                    },
                },
                {
                    office_name: 'Budget Office',
                    services: {
                        external: [],
                        internal: [
                            'Certifying Fund Allocation',
                            'Processing of Obligations',
                        ],
                    },
                },
                {
                    office_name: "Cashier's Office",
                    services: {
                        external: [
                            'Claiming of Cash Benefits Over the Counter',
                            'Claiming of Checks',
                            'Payment of Fees',
                            'Payment through Checks',
                            'Receipt of Other Fees',
                            'Signing of Clearances',
                        ],
                        internal: [],
                    },
                },
                {
                    office_name: 'Financial Management Office',
                    services: {
                        external: [],
                        internal: ['Certifying Clearance and Signing of Financial Reports'],
                    },
                },
                {
                    office_name: 'General Services Unit',
                    services: {
                        external: [],
                        internal: [
                            'Processing of Job Request for Repair, Maintenance and Utility Works',
                            'Processing of Requested Official Documents via Electronic',
                            'Processing of Requested Official Documents via Face-to-Face Transactions',
                        ],
                    },
                },
                {
                    office_name: 'Human Resources and Management Office',
                    services: {
                        external: [],
                        internal: [
                            'Assistance for Salary Loan Applications and Confirmation of GSIS Loan Applications',
                            'Assistance with the Request for Salary Deductions',
                            'Issuance of Service Records',
                            'Issuance of Notice of Salary Adjustment (NOSA) and Notice of Step Increment (NOSI)',
                            'Issuance of Various Certifications',
                            'Preparation for Pay Slip',
                            'Preparation for Terminal Leave Benefits',
                            'Assistance for GSIS Retirement Claims',
                        ],
                    },
                },
                {
                    office_name: 'Machinery Department',
                    services: {
                        external: ['Requests for Use of University Vehicles'],
                        internal: ['Requests for Use of University Vehicles'],
                    },
                },
                {
                    office_name: 'Medical and Dental Health Services',
                    services: {
                        external: [
                            'Consultation, Treatment and Referral - Online Consultation',
                            'Consultation, Treatment and Referral - Face to face Consultation',
                            'Medical Certificate',
                            'Consultation, Oral Examination, Treatment and Referral - Online Consultation',
                            'Consultation, Oral Examination, Treatment and Referral - Face to Face',
                            'Dental Certificate',
                        ],
                        internal: [],
                    },
                },
                {
                    office_name: 'Office of the Chief Administrative Officer Administrative Services Division',
                    services: {
                        external: [],
                        internal: [
                            'Issuance of Scanned Copy of Attendance Record',
                            'Mimeographing and Duplicating Services',
                        ],
                    },
                },
                {
                    office_name: 'Physical Plant Development Office',
                    services: {
                        external: [
                            'Advance/Progress/Final Billing and Release of Retention Fee',
                            'Final Inspection of Infrastructure Projects',
                            'Issuance of Building Plans, Vicinity Map, other Technical Drawings',
                            'Issuance of Building Plans, Vicinity Map, other Technical Drawings for Academic Purpose',
                        ],
                        internal: [],
                    },
                },
                {
                    office_name: "Records' Office",
                    services: {
                        external: [],
                        internal: [
                            'Request for Copy of Records',
                            'Request for Copy of Records/Information from the University Pursuant to the Freedom of Information',
                        ],
                    },
                },
                {
                    office_name: 'Supply and Property Management Office',
                    services: {
                        external: ['Disposal of Unserviceable Equipment'],
                        internal: [
                            'Purchase Order/Contract of Agreement/Notice to Proceed',
                            'Receiving Delivery of Supplies, Materials and Equipment',
                            'Issuance of Supplies, Materials and Equipment',
                        ],
                    },
                },
                {
                    office_name: 'Office of the Vice President for External Affairs',
                    services: {
                        external: ['Evaluation and Approval of Proposals for Alumni Affairs'],
                        internal: [
                            'Evaluation and Approval of Proposals for Alumni Affairs',
                            'Request for Data on Employability of Graduates',
                        ],
                    },
                },
                {
                    office_name: 'Office of the Vice President for Research, Development, and Extension',
                    services: {
                        external: ['Endorsement of Research / Extension Projects for Payment of Honorarium'],
                        internal: [
                            'Claim of Awards and Other Incentives',
                            'Endorsement of Research/Extension Projects for Payment of Honorarium',
                            'Endorsement of Research Papers for Presentations at the Scientific Fora',
                            'Procedure for Drafting and Filing of Patent, Utility Model, and Industrial Design',
                        ],
                    },
                },
                {
                    office_name: 'Office of International Relations',
                    services: {
                        external: [
                            'Processing and facilitating documents for Internationalization programs such as global partnership, exchange programs and scholarship in research, mobility, capacity building, curriculum and intercultural understanding',
                            'Processing Outbound Faculty and Staff Mobility',
                            'Processing Outbound Students',
                            'Processing of CHED Endorsement for Legitimacy of Travel Abroad',
                        ],
                        internal: [],
                    },
                },
                {
                    office_name: 'University Research and Development Services (URDS)',
                    services: {
                        external: [
                            'Processing Claims of Honorarium for Completed Research',
                            'Processing Claims of Incentives for Publications',
                            'Processing Claims of Incentives for IPPs',
                            'Processing Claims of Incentives for Resource Generation',
                            'Processing Claims of Citation Incentives',
                            'Processing Claims of Incentive for Award-Winning Research Paper',
                        ],
                        internal: [],
                    },
                },
            ],
        },
        {
            campus_name: 'UEP Laoang Campus',
            offices: [
                {
                    office_name: 'Office of the Campus Director',
                    services: {
                        external: ['Action on Contracts and External Agreements'],
                        internal: [
                            'Action/Approval of Letters/Communication from Different Colleges/Offices of the Campus',
                            'Receiving and Releasing of Financial Documents',
                        ],
                    },
                },
                {
                    office_name: 'Guidance and Testing Office',
                    services: {
                        external: ['Testing Services', 'Issuance of Certificate of Good Moral Character'],
                        internal: ['Counseling Services'],
                    },
                },
                {
                    office_name: 'Management and Information System',
                    services: {
                        external: [],
                        internal: ['Enrollment System Operation'],
                    },
                },
                {
                    office_name: 'Office of Sports Affairs',
                    services: {
                        external: [
                            'Selection of University Athletes and Request of Services for Sports Development',
                            'Request for Sports Related Services',
                        ],
                        internal: [],
                    },
                },
                {
                    office_name: 'Office of the Student Affairs',
                    services: {
                        external: ['Testing Services'],
                        internal: ['Accreditation and Re-accreditation of Campus Student Organization'],
                    },
                },
                {
                    office_name: 'Office of the Assistant Director for Academic Affairs',
                    services: {
                        external: [],
                        internal: ['Curriculum Review and Development', 'Outsourcing of Special Lecturers'],
                    },
                },
                {
                    office_name: 'Department of Criminal Justice',
                    services: {
                        external: [
                            'Evaluation on the Admission of New Students, Returnees',
                            'Enrollment of Students',
                            'Request for Expert Services',
                        ],
                        internal: [
                            'Request for Reprinting of COR',
                            'Request for Subject Offerings',
                        ],
                    },
                },
                {
                    office_name: 'Department of Engineering',
                    services: {
                        external: [
                            'Evaluation on the Admission of New Students, Returnees',
                            'Enrollment of Students',
                            'Request for Expert Services',
                        ],
                        internal: [
                            'Request for Reprinting of COR',
                            'Request for Subject Offerings',
                        ],
                    },
                },
                {
                    office_name: 'Department of Industrial Technology',
                    services: {
                        external: [
                            'Evaluation on the Admission of New Students, Returnees',
                            'Enrollment of Students',
                            'Request for Expert Services',
                        ],
                        internal: [
                            'Request for Reprinting of COR',
                            'Request for Subject Offerings',
                        ],
                    },
                },
                {
                    office_name: 'Department of Teacher Education',
                    services: {
                        external: [
                            'Evaluation on the Admission of New Students, Returnees',
                            'Enrollment of Students',
                            'Request for Expert Services',
                        ],
                        internal: [
                            'Request for Reprinting of COR',
                            'Request for Subject Offerings',
                        ],
                    },
                },
                {
                    office_name: 'Office of the Registrar',
                    services: {
                        external: [
                            'Request for Transcript of Records (TOR) Manual',
                            'Request for Transcript of Records (TOR) Manual (Computer generated)',
                            'Request for Transcript of Records with Honorable Dismissal',
                            'Request for Authentication of Academics Records',
                            'Request for Authentication of Reports of Grades, Certificate of Registration (COR)',
                            'Educational Record Verification',
                            'Issuance of Academic Record, and other Documents for Abroad',
                        ],
                        internal: [
                            'Application and Receiving of Application, Approval up to Final Release of List of Graduates',
                            'Request for Change or Edit of Grades',
                            'Request for Completion of Incomplete Grades (INC)',
                        ],
                    },
                },
                {
                    office_name: 'UEP Laoang Laboratory High School (UEPLLHS)',
                    services: {
                        external: [
                            'Admission of New Student',
                            'Enrollment',
                            "Issuance of Certification and Form 137/School form 10/ Student's Permanent Records",
                        ],
                        internal: [],
                    },
                },
                {
                    office_name: 'Office of the Assistant Director for Administration and Finance',
                    services: {
                        external: [],
                        internal: [
                            'Approving Application for Leave of Employees (Non-Teaching Personnel)',
                            'Signing Communication, Monitoring Reports, and Endorsement Documents',
                            'Signing of Disbursement Voucher for Capital Outlay (CO) Expenditure',
                            'Signing of Disbursement Voucher for Personnel Services (PS) Expenditures',
                            'Signing the Obligation Request and Status (ORS)',
                            'Signing the Budget Utilization Request and Status (BURS)',
                        ],
                    },
                },
                {
                    office_name: 'Accounting Office',
                    services: {
                        external: [
                            'Issuance of Order of Payment',
                            'Issuance of Student Statement of Account',
                            'Processing of Disbursement Voucher',
                        ],
                        internal: [],
                    },
                },
                {
                    office_name: 'Budget Office',
                    services: {
                        external: [],
                        internal: [
                            'Certifying Availability of Funds to Job Orders, Contract of Service, Travel Requests, Purchase and Job Requests',
                            'Processing of Obligation or Budget Utilization',
                        ],
                    },
                },
                {
                    office_name: "Cashier's Office",
                    services: {
                        external: [],
                        internal: ['Cash Disbursement', 'Check Disbursements'],
                    },
                },
                {
                    office_name: 'Human Resource Management Office',
                    services: {
                        external: ['Issuance of Service Records', 'Recruitment, Selection, and Placement Services'],
                        internal: [
                            'Assistance for Loan Application',
                            'Preparation of Travel Order',
                            'Processing of Leave Application (Form 6)',
                        ],
                    },
                },
                {
                    office_name: 'ID Production',
                    services: {
                        external: [],
                        internal: ['Production of Identification Cards'],
                    },
                },
                {
                    office_name: 'Library Services',
                    services: {
                        external: [
                            'Circulation Services',
                            'Library Tour/ Orientation',
                            'Reference and Information Services',
                            'Referral to Other Institution',
                        ],
                        internal: [],
                    },
                },
                {
                    office_name: 'Medical Health Services',
                    services: {
                        external: [],
                        internal: [
                            'Consultation, Treatment and Referral',
                            'Provision of First Aid Kits',
                            'Distribution of Vitamin C',
                        ],
                    },
                },
                {
                    office_name: 'Supply Management Office',
                    services: {
                        external: ['Awarding and Confirmation of Purchase Order'],
                        internal: [
                            'Purchase Request',
                            'Purchase Order',
                            'Inspection of supplies, Materials and Equipment',
                            'Payment of Supplies, Materials and Equipment',
                            'Releasing Supplies, Materials and Equipment',
                        ],
                    },
                },
                {
                    office_name: 'Office of the Assistant Director for External Affairs',
                    services: {
                        external: ['Evaluation and Approval of Proposals for Alumni Affairs'],
                        internal: ['Request for Data on Employability of Graduates'],
                    },
                },
                {
                    office_name: 'Office of the Student Internship Program of the Philippines',
                    services: {
                        external: [],
                        internal: ['Preparation and Submission of Student Internship Documents'],
                    },
                },
            ],
        },
        {
            campus_name: 'UEP Catubig Campus',
            offices: [
                {
                    office_name: 'Office of the Campus Director',
                    services: {
                        external: [
                            'Coordinating Arts & Culture Participation Requests',
                            'Facilitating Invitations for Resource Speakers, Judges, Research Evaluators, and Expert Services',
                            'Request for Payment/Billing (Construction Projects and Supplies)',
                            'Request for Payment/Billing (Institutional Fees, Membership Fees Issuance, etc.)',
                            'Request for Submission/Compliance',
                            'Request for Utilization of University Facilities/Equipment/Venue',
                            'Responding to Various Inquiries',
                        ],
                        internal: [],
                    },
                },
                {
                    office_name: 'Guidance and Testing Center Office',
                    services: {
                        external: ['College Entrance Examination', 'Request for Counselling Session'],
                        internal: [],
                    },
                },
                {
                    office_name: 'National Service Training Program',
                    services: {
                        external: [
                            'Application for Graduation/Clearance',
                            'Request for Issuance of Serial Numbers',
                            'Request for NSTP Certification',
                            'Registration of NSTP Trainees',
                        ],
                        internal: [],
                    },
                },
                {
                    office_name: 'Office of the Student Affairs and Services',
                    services: {
                        external: [
                            'Accreditation and Re-Accreditation of Campus Student Organizations',
                            'Externally Funded Scholarship/Financial Assistance Program Application',
                            'Free Higher Education Program Application',
                            'Internally Funded Scholarship/Financial Assistance Program Application',
                            'Internship Deployment Process',
                            'Issuance of Certificate of No Scholarship',
                            'Publication of Newsletter and Special Publication',
                            'Socio-Cultural Affairs',
                            'Sports Affairs',
                            'Student Grievances',
                        ],
                        internal: [],
                    },
                },
                {
                    office_name: 'Office of the Management Information System',
                    services: {
                        external: [
                            'Request for CCTV Review and Data Backup',
                            'Request for ICT Services',
                            'Request for Grant of Biometrics Access',
                            'Request for LED Wall Use',
                            'Request for Printing of Data',
                            'Request for Transfer of Load',
                            'Request for Withdrawal/Cancellation of Enrolment for Current Semester',
                            'Request for Withdrawal of Load/Subjects',
                        ],
                        internal: [],
                    },
                },
                {
                    office_name: 'Assistant Director for Academic Affairs - Agriculture Department',
                    services: {
                        external: [
                            'Request for Issuance of a Recommendation for Employment',
                            'Request for Good Moral Character',
                        ],
                        internal: [],
                    },
                },
                {
                    office_name: 'Criminal Justice Department',
                    services: {
                        external: [
                            'Request for Issuance of a Recommendation for Employment',
                            'Request for Good Moral Character',
                        ],
                        internal: [],
                    },
                },
                {
                    office_name: 'Education Department',
                    services: {
                        external: [
                            'Request for Issuance of a Recommendation for Employment',
                            'Request for Good Moral Character',
                        ],
                        internal: [],
                    },
                },
                {
                    office_name: 'Hospitality Management Department',
                    services: {
                        external: [
                            'Request for Issuance of a Recommendation for Employment',
                            'Request for Good Moral Character',
                        ],
                        internal: [],
                    },
                },
                {
                    office_name: 'Industrial Technology Department',
                    services: {
                        external: [
                            'Request for Issuance of a Recommendation for Employment',
                            'Request for Good Moral Character',
                        ],
                        internal: [],
                    },
                },
                {
                    office_name: 'UEP-PRMC Library',
                    services: {
                        external: [
                            'Borrowing of Books',
                            'Circulation Services',
                            'Online Learning and Encoding Station',
                            'Reference Services',
                        ],
                        internal: [],
                    },
                },
                {
                    office_name: 'Office of the Registrar',
                    services: {
                        external: [
                            'Application for Adding/Changing/Dropping of Subjects',
                            'Application for Graduation',
                            'Application for Shifting',
                            'Certification',
                            'Enrollment',
                            'Evaluation of Academic Records',
                            'Printing of Certificate of Registration (COR)',
                            'Report Card',
                            'Transcript of Records (TOR) Diploma',
                            'Transfer Credentials (Honorable Dismissal/Certificate of Good Moral)',
                        ],
                        internal: [],
                    },
                },
                {
                    office_name: 'Laboratory High School (Junior and Senior High School)',
                    services: {
                        external: [
                            'Admission Procedures',
                            'Enrollment Procedures',
                            'Issuance of Good Moral Character',
                            "Issuance of Schools' Certification and Authentication",
                            'Issuance of SF 10 (Form 137)',
                        ],
                        internal: [],
                    },
                },
                {
                    office_name: 'Office of the Assistant Director for Administration',
                    services: {
                        external: [],
                        internal: ['Seeking Signature for Procurement, Financial & Other Documents'],
                    },
                },
                {
                    office_name: 'Accounting Office',
                    services: {
                        external: [
                            'Processing of Claims for External and Internal Clients',
                            'Preparation of Job Order/Part-Time Lecturers’ Payroll',
                            'Preparation of Pay Slip',
                        ],
                        internal: [
                            'Certifying Clearance Free from Money and Property Accountability',
                            'Certifying Fund Availability',
                        ],
                    },
                },
                {
                    office_name: 'Budget Office',
                    services: {
                        external: [],
                        internal: [
                            'Certifying Fund Allocation',
                            'Issuance of Copy of Budgetary Documents for Accreditation and Financial Status Inquiry',
                            'Obligation of Claims for External and Internal Campuses',
                        ],
                    },
                },
                {
                    office_name: "Cashier's Office",
                    services: {
                        external: [
                            'Cash Disbursements',
                            'Check Disbursements/List of Due and Demandable-Accounts Payable',
                            'Advice to Debit Accounts (LDDAP-ADAP)/ Advice to ADA Issued and Cancelled (ADAIC)',
                            'Collection',
                        ],
                        internal: [],
                    },
                },
                {
                    office_name: 'General Services Unit',
                    services: {
                        external: [],
                        internal: ['Request for Repair and Maintenance', 'Request for Use of a Vehicle'],
                    },
                },
                {
                    office_name: 'Human Resource Management Office',
                    services: {
                        external: [
                            'Issuance of Service Records',
                            'Recruitment, Selection, and Placement Services',
                        ],
                        internal: [
                            'Assistance for Loan Application',
                            'Preparation of Travel Order',
                            'Processing of Leave Application (Form 6)',
                        ],
                    },
                },
                {
                    office_name: 'Office of the Business Affairs',
                    services: {
                        external: [
                            'Requests for Use and Rental of UEP-PRMC Facilities and Rentals of Hostel and DAL',
                            'Requests for School Identification Card of Students',
                            'Requests for the Use UEP-PRMC Facilities and Rental of Arcade',
                            'Requests for UEP-PRMC Canteen',
                        ],
                        internal: [],
                    },
                },
                {
                    office_name: "Record's Office",
                    services: {
                        external: [
                            'Request for Copy of Records/Information from the University Pursuant to the Freedom of Information',
                        ],
                        internal: ['Request for Copy of Records'],
                    },
                },
                {
                    office_name: 'Supply Office',
                    services: {
                        external: [],
                        internal: [
                            'Purchase Request/Job Order/APR',
                            'Purchase Request/Securing Procurement Request to DBM-PS',
                            'Confirmation of Purchase Order/Contract',
                            'Release of Supplies/Materials/Equipment',
                        ],
                    },
                },
                {
                    office_name: 'Office of the Assistant Director for External Affairs',
                    services: {
                        external: ['Evaluation and Approval of Proposals for Alumni Affairs'],
                        internal: ['Request for Data on Employability of Graduates'],
                    },
                },
            ],
        },
    ],
};

function buildCampusOfficeMaps(data) {
    const officesByCampus = {};
    const servicesByCampusOffice = {};
    (data.campuses || []).forEach((campus) => {
        const cname = campus.campus_name;
        const offices = campus.offices || [];
        officesByCampus[cname] = offices.map((o) => o.office_name);
        const officeMap = {};
        offices.forEach((o) => {
            officeMap[o.office_name] = o.services || { external: [], internal: [] };
        });
        servicesByCampusOffice[cname] = officeMap;
    });
    return { officesByCampus, servicesByCampusOffice };
}

// Feedback Form Alpine.js Component
// Register with Alpine when it's available (works with CDN)
document.addEventListener('alpine:init', () => {
    const { officesByCampus, servicesByCampusOffice } = buildCampusOfficeMaps(servicesData);
    Alpine.data('feedbackForm', (transactionDate, questionsCount) => ({
        step: 1,
        totalSteps: 3,
        questionsCount: questionsCount || 0,
        officesByCampus,
        servicesByCampusOffice,
        formData: {
            unit_office: 'ODFI',
            transaction_date: transactionDate || new Date().toISOString().split('T')[0],
            client_name: '',
            client_type: '',
            sex: '',
            age: '',
            region: 'VIII',
            campus: '',
            office: '',
            service_choice: '',
            service_other: '',
            service_availed: '',
            email: '',
            cc1_awareness: '',
            cc2_visibility: '',
            cc3_helpfulness: '',
            suggestions: '',
            responses: {}
        },
        updateService(choice) {
            this.formData.service_choice = choice;
            if (choice === 'other') {
                this.formData.service_availed = '';
                this.formData.service_other = '';
            } else {
                this.formData.service_availed = choice;
                this.formData.service_other = '';
            }
        },
        campusOffices() {
            return this.officesByCampus[this.formData.campus] || [];
        },
        filteredServices() {
            if (!this.formData.campus || !this.formData.office || !this.formData.client_type) {
                return [];
            }
            const campusMap = this.servicesByCampusOffice[this.formData.campus] || {};
            const officeServices = campusMap[this.formData.office] || { external: [], internal: [] };
            const isExternalType = ['Citizen', 'Business', 'External'].includes(this.formData.client_type);
            return isExternalType ? officeServices.external : officeServices.internal;
        },
        onCampusChange(value) {
            this.formData.campus = value;
            this.formData.office = '';
            this.formData.service_choice = '';
            this.formData.service_other = '';
            this.formData.service_availed = '';
        },
        isStepValid(step = this.step) {
            if (step === 1) {
                return (
                    this.formData.unit_office?.trim() &&
                    this.formData.transaction_date &&
                    this.formData.client_type &&
                    this.formData.sex &&
                    this.formData.age &&
                    Number(this.formData.age) > 0 &&
                    this.formData.region?.trim() &&
                    this.formData.campus?.trim() &&
                    this.formData.office?.trim() &&
                    this.formData.service_availed?.trim()
                );
            }

            if (step === 2) {
                if (!this.formData.cc1_awareness) return false;
                if (this.formData.cc1_awareness !== '4') {
                    return !!(this.formData.cc2_visibility && this.formData.cc3_helpfulness);
                }
                return true; // awareness = 4, CC2/CC3 N/A handled as 0
            }

            if (step === 3) {
                // Ensure every question has a response
                const responses = this.formData.responses || {};
                return (
                    Object.keys(responses).length === this.questionsCount &&
                    Object.values(responses).every((v) => v !== undefined && v !== null && v !== '')
                );
            }

            return true;
        },
        nextStep() {
            if (this.isStepValid(this.step) && this.step < this.totalSteps) {
                this.step++;
            }
        },
        prevStep() {
            if (this.step > 1) {
                this.step--;
            }
        },
        goToStep(stepNumber) {
            if (stepNumber >= 1 && stepNumber <= this.totalSteps && this.isStepValid(this.step)) {
                this.step = stepNumber;
            }
        }
    }));
});

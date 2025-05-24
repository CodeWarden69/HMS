<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar {
            transition: all 0.3s;
        }
        .sidebar.collapsed {
            width: 70px;
        }
        .sidebar.collapsed .nav-text {
            display: none;
        }
        .sidebar.collapsed .logo-text {
            display: none;
        }
        .sidebar.collapsed .nav-item {
            justify-content: center;
        }
        .main-content {
            transition: all 0.3s;
        }
        .sidebar.collapsed + .main-content {
            margin-left: 70px;
        }
        .active-nav {
            background-color: #3b82f6;
            color: white !important;
        }
        .active-nav svg {
            color: white !important;
        }
        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .modal {
            transition: all 0.3s ease;
            opacity: 0;
            visibility: hidden;
        }
        .modal.active {
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="sidebar bg-white shadow-lg h-full fixed z-10 w-64">
            <div class="p-4 flex items-center border-b">
                <i class="fas fa-hospital text-blue-500 text-2xl mr-3"></i>
                <span class="logo-text text-xl font-bold text-gray-800">MediCare</span>
            </div>
            <div class="p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="nav-item flex items-center p-2 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600" onclick="loadSection('dashboard')">
                            <i class="fas fa-tachometer-alt text-gray-500"></i>
                            <span class="nav-text ml-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-item flex items-center p-2 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600" onclick="loadSection('patients')">
                            <i class="fas fa-user-injured text-gray-500"></i>
                            <span class="nav-text ml-3">Patients</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-item flex items-center p-2 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600" onclick="loadSection('doctors')">
                            <i class="fas fa-user-md text-gray-500"></i>
                            <span class="nav-text ml-3">Doctors</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-item flex items-center p-2 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600" onclick="loadSection('nurses')">
                            <i class="fas fa-user-nurse text-gray-500"></i>
                            <span class="nav-text ml-3">Nurses</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-item flex items-center p-2 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600" onclick="loadSection('appointments')">
                            <i class="fas fa-calendar-check text-gray-500"></i>
                            <span class="nav-text ml-3">Appointments</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-item flex items-center p-2 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600" onclick="loadSection('wards')">
                            <i class="fas fa-procedures text-gray-500"></i>
                            <span class="nav-text ml-3">Wards</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-item flex items-center p-2 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600" onclick="loadSection('treatments')">
                            <i class="fas fa-notes-medical text-gray-500"></i>
                            <span class="nav-text ml-3">Treatments</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-item flex items-center p-2 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600" onclick="loadSection('medications')">
                            <i class="fas fa-pills text-gray-500"></i>
                            <span class="nav-text ml-3">Medications</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-item flex items-center p-2 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600" onclick="loadSection('billing')">
                            <i class="fas fa-file-invoice-dollar text-gray-500"></i>
                            <span class="nav-text ml-3">Billing</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-item flex items-center p-2 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600" onclick="logout()">
                            <i class="fas fa-sign-out-alt text-gray-500"></i>
                            <span class="nav-text ml-3">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="absolute bottom-0 w-full p-4">
                <button onclick="toggleSidebar()" class="w-full flex items-center justify-center p-2 text-gray-600 rounded-lg hover:bg-gray-100">
                    <i class="fas fa-chevron-left"></i>
                    <span class="nav-text ml-3">Collapse</span>
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-1 overflow-auto ml-64">
            <!-- Top Navigation -->
            <nav class="bg-white shadow-sm p-4 flex justify-between items-center">
                <div class="flex items-center">
                    <button onclick="toggleSidebar()" class="mr-4 text-gray-600 hover:text-blue-600">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 id="page-title" class="text-xl font-semibold text-gray-800">Dashboard</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="text-gray-600 hover:text-blue-600">
                            <i class="fas fa-bell"></i>
                            <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                        </button>
                    </div>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="User" class="h-8 w-8 rounded-full">
                        <span class="ml-2 text-gray-700"><b>Welcome, Admin</b></span>
                    </div>
                </div>
            </nav>

            <!-- Main Content Area -->
            <div class="p-6">
                <div id="content-area" class="fade-in">
                    <!-- Dashboard content will be loaded here -->
                    <div id="dashboard-content">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                            <div class="bg-white rounded-lg shadow p-6 flex items-center">
                                <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                                    <i class="fas fa-user-injured text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-500">Total Patients</p>
                                    <h3 class="text-2xl font-bold" id="total-patients">0</h3>
                                </div>
                            </div>
                            <div class="bg-white rounded-lg shadow p-6 flex items-center">
                                <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                                    <i class="fas fa-user-md text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-500">Total Doctors</p>
                                    <h3 class="text-2xl font-bold" id="total-doctors">0</h3>
                                </div>
                            </div>
                            <div class="bg-white rounded-lg shadow p-6 flex items-center">
                                <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                                    <i class="fas fa-calendar-check text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-500">Today's Appointments</p>
                                    <h3 class="text-2xl font-bold" id="total-appointments">0</h3>
                                </div>
                            </div>
                            <div class="bg-white rounded-lg shadow p-6 flex items-center">
                                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                                    <i class="fas fa-procedures text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-500">Available Wards</p>
                                    <h3 class="text-2xl font-bold" id="total-wards">0</h3>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                            <div class="bg-white rounded-lg shadow p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-semibold">Recent Appointments</h3>
                                    <a href="#" class="text-blue-600 text-sm" onclick="loadSection('appointments')">View All</a>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full">
                                        <thead>
                                            <tr class="text-left text-gray-500 text-sm border-b">
                                                <th class="pb-2">ID</th>
                                                <th class="pb-2">Patient</th>
                                                <th class="pb-2">Doctor</th>
                                                <th class="pb-2">Date</th>
                                                <th class="pb-2">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="recent-appointments">
                                            <!-- Will be populated by JS -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="bg-white rounded-lg shadow p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-semibold">Recent Patients</h3>
                                    <a href="#" class="text-blue-600 text-sm" onclick="loadSection('patients')">View All</a>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full">
                                        <thead>
                                            <tr class="text-left text-gray-500 text-sm border-b">
                                                <th class="pb-2">ID</th>
                                                <th class="pb-2">Name</th>
                                                <th class="pb-2">Gender</th>
                                                <th class="pb-2">Phone</th>
                                                <th class="pb-2">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="recent-patients">
                                            <!-- Will be populated by JS -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Patients content will be loaded here -->
                    <div id="patients-content" class="hidden">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-800">Patient Management</h2>
                            <button onclick="showPatientForm()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                                <i class="fas fa-plus mr-2"></i> Add Patient
                            </button>
                        </div>

                        <!-- Patient Form -->
                        <div id="patient-form-container" class="bg-white rounded-lg shadow p-6 mb-6 hidden">
                            <h3 class="text-lg font-semibold mb-4" id="patient-form-title">Add New Patient</h3>
                            <form id="patient-form" action="save_patient.php" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="hidden" id="patient-id" name="patient-id">
                                <div>
                                    <label for="patient-name" class="block text-gray-700 mb-2">Full Name</label>
                                    <input type="text" id="patient-name" name="patient-name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label for="patient-gender" class="block text-gray-700 mb-2">Gender</label>
                                    <select id="patient-gender" name="patient-gender" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="patient-dob" class="block text-gray-700 mb-2">Date of Birth</label>
                                    <input type="date" id="patient-dob" name="patient-dob" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label for="patient-phone" class="block text-gray-700 mb-2">Phone Number</label>
                                    <input type="tel" id="patient-phone" name="patient-phone" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div class="md:col-span-2">
                                    <label for="patient-address" class="block text-gray-700 mb-2">Address</label>
                                    <textarea id="patient-address" name="patient-address" rows="3" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                                </div>
                                <div class="md:col-span-2 flex justify-end space-x-3">
                                    <button type="submit" onclick="hidePatientForm()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">Cancel</button>
                                    <button type="" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Save Patient</button>
                                </div>
                            </form>
                        </div>

                        <!-- Patients Table -->
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <div class="p-4 border-b flex justify-between items-center">
                                <div class="flex items-center">
                                    <input type="text" id="patient-search" placeholder="Search patients..." class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <button onclick="refreshPatients()" class="text-gray-600 hover:text-blue-600">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DOB</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="patients-table" class="bg-white divide-y divide-gray-200">
                                        <!-- Will be populated by JS -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="p-4 border-t flex justify-between items-center">
                                <div class="text-sm text-gray-500">
                                    Showing <span id="patient-start">1</span> to <span id="patient-end">10</span> of <span id="patient-total">0</span> patients
                                </div>
                                <div class="flex space-x-2">
                                    <button id="patient-prev" onclick="prevPatientPage()" class="px-3 py-1 border rounded-lg text-gray-700 disabled:opacity-50" disabled>Previous</button>
                                    <button id="patient-next" onclick="nextPatientPage()" class="px-3 py-1 border rounded-lg text-gray-700 disabled:opacity-50" disabled>Next</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Doctors content will be loaded here -->
                    <div id="doctors-content" class="hidden">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-800">Doctor Management</h2>
                            <button onclick="showDoctorForm()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                                <i class="fas fa-plus mr-2"></i> Add Doctor
                            </button>
                        </div>

                        <!-- Doctor Form -->
                        <div id="doctor-form-container" class="bg-white rounded-lg shadow p-6 mb-6 hidden">
                            <h3 class="text-lg font-semibold mb-4" id="doctor-form-title">Add New Doctor</h3>
                            <form id="doctor-form" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="hidden" id="doctor-id">
                                <div>
                                    <label for="doctor-name" class="block text-gray-700 mb-2">Full Name</label>
                                    <input type="text" id="doctor-name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label for="doctor-specialization" class="block text-gray-700 mb-2">Specialization</label>
                                    <input type="text" id="doctor-specialization" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label for="doctor-email" class="block text-gray-700 mb-2">Email</label>
                                    <input type="email" id="doctor-email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label for="doctor-phone" class="block text-gray-700 mb-2">Phone Number</label>
                                    <input type="tel" id="doctor-phone" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div class="md:col-span-2 flex justify-end space-x-3">
                                    <button type="button" onclick="hideDoctorForm()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">Cancel</button>
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Save Doctor</button>
                                </div>
                            </form>
                        </div>

                        <!-- Doctors Table -->
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <div class="p-4 border-b flex justify-between items-center">
                                <div class="flex items-center">
                                    <input type="text" id="doctor-search" placeholder="Search doctors..." class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <button onclick="refreshDoctors()" class="text-gray-600 hover:text-blue-600">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Specialization</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="doctors-table" class="bg-white divide-y divide-gray-200">
                                        <!-- Will be populated by JS -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="p-4 border-t flex justify-between items-center">
                                <div class="text-sm text-gray-500">
                                    Showing <span id="doctor-start">1</span> to <span id="doctor-end">10</span> of <span id="doctor-total">0</span> doctors
                                </div>
                                <div class="flex space-x-2">
                                    <button id="doctor-prev" onclick="prevDoctorPage()" class="px-3 py-1 border rounded-lg text-gray-700 disabled:opacity-50" disabled>Previous</button>
                                    <button id="doctor-next" onclick="nextDoctorPage()" class="px-3 py-1 border rounded-lg text-gray-700 disabled:opacity-50" disabled>Next</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Nurses content will be loaded here -->
                    <div id="nurses-content" class="hidden">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-800">Nurse Management</h2>
                            <button onclick="showNurseForm()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                                <i class="fas fa-plus mr-2"></i> Add Nurse
                            </button>
                        </div>

                        <!-- Nurse Form -->
                        <div id="nurse-form-container" class="bg-white rounded-lg shadow p-6 mb-6 hidden">
                            <h3 class="text-lg font-semibold mb-4" id="nurse-form-title">Add New Nurse</h3>
                            <form id="nurse-form" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="hidden" id="nurse-id">
                                <div>
                                    <label for="nurse-name" class="block text-gray-700 mb-2">Full Name</label>
                                    <input type="text" id="nurse-name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label for="nurse-ward" class="block text-gray-700 mb-2">Assigned Ward</label>
                                    <input type="text" id="nurse-ward" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label for="nurse-email" class="block text-gray-700 mb-2">Email</label>
                                    <input type="email" id="nurse-email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label for="nurse-phone" class="block text-gray-700 mb-2">Phone Number</label>
                                    <input type="tel" id="nurse-phone" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div class="md:col-span-2 flex justify-end space-x-3">
                                    <button type="button" onclick="hideNurseForm()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">Cancel</button>
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Save Nurse</button>
                                </div>
                            </form>
                        </div>

                        <!-- Nurses Table -->
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <div class="p-4 border-b flex justify-between items-center">
                                <div class="flex items-center">
                                    <input type="text" id="nurse-search" placeholder="Search nurses..." class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <button onclick="refreshNurses()" class="text-gray-600 hover:text-blue-600">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigned Ward</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="nurses-table" class="bg-white divide-y divide-gray-200">
                                        <!-- Will be populated by JS -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="p-4 border-t flex justify-between items-center">
                                <div class="text-sm text-gray-500">
                                    Showing <span id="nurse-start">1</span> to <span id="nurse-end">10</span> of <span id="nurse-total">0</span> nurses
                                </div>
                                <div class="flex space-x-2">
                                    <button id="nurse-prev" onclick="prevNursePage()" class="px-3 py-1 border rounded-lg text-gray-700 disabled:opacity-50" disabled>Previous</button>
                                    <button id="nurse-next" onclick="nextNursePage()" class="px-3 py-1 border rounded-lg text-gray-700 disabled:opacity-50" disabled>Next</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Appointments content will be loaded here -->
                    <div id="appointments-content" class="hidden">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-800">Appointment Management</h2>
                            <button onclick="showAppointmentForm()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                                <i class="fas fa-plus mr-2"></i> Schedule Appointment
                            </button>
                        </div>

                        <!-- Appointment Form -->
                        <div id="appointment-form-container" class="bg-white rounded-lg shadow p-6 mb-6 hidden">
                            <h3 class="text-lg font-semibold mb-4" id="appointment-form-title">Schedule New Appointment</h3>
                            <form id="appointment-form" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="hidden" id="appointment-id">
                                <div>
                                    <label for="appointment-patient" class="block text-gray-700 mb-2">Patient</label>
                                    <select id="appointment-patient" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                        <option value="">Select Patient</option>
                                        <!-- Will be populated by JS -->
                                    </select>
                                </div>
                                <div>
                                    <label for="appointment-doctor" class="block text-gray-700 mb-2">Doctor</label>
                                    <select id="appointment-doctor" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                        <option value="">Select Doctor</option>
                                        <!-- Will be populated by JS -->
                                    </select>
                                </div>
                                <div>
                                    <label for="appointment-date" class="block text-gray-700 mb-2">Date</label>
                                    <input type="date" id="appointment-date" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label for="appointment-time" class="block text-gray-700 mb-2">Time</label>
                                    <input type="time" id="appointment-time" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label for="appointment-status" class="block text-gray-700 mb-2">Status</label>
                                    <select id="appointment-status" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                        <option value="Scheduled">Scheduled</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                </div>
                                <div class="md:col-span-2 flex justify-end space-x-3">
                                    <button type="button" onclick="hideAppointmentForm()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">Cancel</button>
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Save Appointment</button>
                                </div>
                            </form>
                        </div>

                        <!-- Appointments Table -->
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <div class="p-4 border-b flex justify-between items-center">
                                <div class="flex items-center">
                                    <input type="text" id="appointment-search" placeholder="Search appointments..." class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <button onclick="refreshAppointments()" class="text-gray-600 hover:text-blue-600">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Doctor</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="appointments-table" class="bg-white divide-y divide-gray-200">
                                        <!-- Will be populated by JS -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="p-4 border-t flex justify-between items-center">
                                <div class="text-sm text-gray-500">
                                    Showing <span id="appointment-start">1</span> to <span id="appointment-end">10</span> of <span id="appointment-total">0</span> appointments
                                </div>
                                <div class="flex space-x-2">
                                    <button id="appointment-prev" onclick="prevAppointmentPage()" class="px-3 py-1 border rounded-lg text-gray-700 disabled:opacity-50" disabled>Previous</button>
                                    <button id="appointment-next" onclick="nextAppointmentPage()" class="px-3 py-1 border rounded-lg text-gray-700 disabled:opacity-50" disabled>Next</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Wards content will be loaded here -->
                    <div id="wards-content" class="hidden">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-800">Ward Management</h2>
                            <button onclick="showWardForm()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                                <i class="fas fa-plus mr-2"></i> Add Ward
                            </button>
                        </div>

                        <!-- Ward Form -->
                        <div id="ward-form-container" class="bg-white rounded-lg shadow p-6 mb-6 hidden">
                            <h3 class="text-lg font-semibold mb-4" id="ward-form-title">Add New Ward</h3>
                            <form id="ward-form" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="hidden" id="ward-id">
                                <div>
                                    <label for="ward-name" class="block text-gray-700 mb-2">Ward Name</label>
                                    <input type="text" id="ward-name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label for="ward-type" class="block text-gray-700 mb-2">Ward Type</label>
                                    <select id="ward-type" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                        <option value="">Select Type</option>
                                        <option value="General">General</option>
                                        <option value="ICU">ICU</option>
                                        <option value="Pediatric">Pediatric</option>
                                        <option value="Maternity">Maternity</option>
                                        <option value="Surgical">Surgical</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="ward-capacity" class="block text-gray-700 mb-2">Capacity</label>
                                    <input type="number" id="ward-capacity" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label for="ward-status" class="block text-gray-700 mb-2">Status</label>
                                    <select id="ward-status" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                        <option value="Available">Available</option>
                                        <option value="Full">Full</option>
                                        <option value="Maintenance">Under Maintenance</option>
                                    </select>
                                </div>
                                <div class="md:col-span-2 flex justify-end space-x-3">
                                    <button type="button" onclick="hideWardForm()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">Cancel</button>
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Save Ward</button>
                                </div>
                            </form>
                        </div>

                        <!-- Wards Table -->
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <div class="p-4 border-b flex justify-between items-center">
                                <div class="flex items-center">
                                    <input type="text" id="ward-search" placeholder="Search wards..." class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <button onclick="refreshWards()" class="text-gray-600 hover:text-blue-600">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ward Name</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Capacity</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="wards-table" class="bg-white divide-y divide-gray-200">
                                        <!-- Will be populated by JS -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="p-4 border-t flex justify-between items-center">
                                <div class="text-sm text-gray-500">
                                    Showing <span id="ward-start">1</span> to <span id="ward-end">10</span> of <span id="ward-total">0</span> wards
                                </div>
                                <div class="flex space-x-2">
                                    <button id="ward-prev" onclick="prevWardPage()" class="px-3 py-1 border rounded-lg text-gray-700 disabled:opacity-50" disabled>Previous</button>
                                    <button id="ward-next" onclick="nextWardPage()" class="px-3 py-1 border rounded-lg text-gray-700 disabled:opacity-50" disabled>Next</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Treatments content will be loaded here -->
                    <div id="treatments-content" class="hidden">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-800">Treatment Management</h2>
                            <button onclick="showTreatmentForm()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                                <i class="fas fa-plus mr-2"></i> Add Treatment
                            </button>
                        </div>

                        <!-- Treatment Form -->
                        <div id="treatment-form-container" class="bg-white rounded-lg shadow p-6 mb-6 hidden">
                            <h3 class="text-lg font-semibold mb-4" id="treatment-form-title">Add New Treatment</h3>
                            <form id="treatment-form" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="hidden" id="treatment-id">
                                <div>
                                    <label for="treatment-name" class="block text-gray-700 mb-2">Treatment Name</label>
                                    <input type="text" id="treatment-name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label for="treatment-patient" class="block text-gray-700 mb-2">Patient</label>
                                    <select id="treatment-patient" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                        <option value="">Select Patient</option>
                                        <!-- Will be populated by JS -->
                                    </select>
                                </div>
                                <div>
                                    <label for="treatment-doctor" class="block text-gray-700 mb-2">Doctor</label>
                                    <select id="treatment-doctor" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                        <option value="">Select Doctor</option>
                                        <!-- Will be populated by JS -->
                                    </select>
                                </div>
                                <div>
                                    <label for="treatment-date" class="block text-gray-700 mb-2">Date</label>
                                    <input type="date" id="treatment-date" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div class="md:col-span-2">
                                    <label for="treatment-description" class="block text-gray-700 mb-2">Description</label>
                                    <textarea id="treatment-description" rows="3" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                                </div>
                                <div class="md:col-span-2 flex justify-end space-x-3">
                                    <button type="button" onclick="hideTreatmentForm()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">Cancel</button>
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Save Treatment</button>
                                </div>
                            </form>
                        </div>

                        <!-- Treatments Table -->
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <div class="p-4 border-b flex justify-between items-center">
                                <div class="flex items-center">
                                    <input type="text" id="treatment-search" placeholder="Search treatments..." class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <button onclick="refreshTreatments()" class="text-gray-600 hover:text-blue-600">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Treatment Name</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Doctor</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="treatments-table" class="bg-white divide-y divide-gray-200">
                                        <!-- Will be populated by JS -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="p-4 border-t flex justify-between items-center">
                                <div class="text-sm text-gray-500">
                                    Showing <span id="treatment-start">1</span> to <span id="treatment-end">10</span> of <span id="treatment-total">0</span> treatments
                                </div>
                                <div class="flex space-x-2">
                                    <button id="treatment-prev" onclick="prevTreatmentPage()" class="px-3 py-1 border rounded-lg text-gray-700 disabled:opacity-50" disabled>Previous</button>
                                    <button id="treatment-next" onclick="nextTreatmentPage()" class="px-3 py-1 border rounded-lg text-gray-700 disabled:opacity-50" disabled>Next</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Medications content will be loaded here -->
                    <div id="medications-content" class="hidden">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-800">Medication Management</h2>
                            <button onclick="showMedicationForm()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                                <i class="fas fa-plus mr-2"></i> Add Medication
                            </button>
                        </div>

                        <!-- Medication Form -->
                        <div id="medication-form-container" class="bg-white rounded-lg shadow p-6 mb-6 hidden">
                            <h3 class="text-lg font-semibold mb-4" id="medication-form-title">Add New Medication</h3>
                            <form id="medication-form" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="hidden" id="medication-id">
                                <div>
                                    <label for="medication-name" class="block text-gray-700 mb-2">Medication Name</label>
                                    <input type="text" id="medication-name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label for="medication-patient" class="block text-gray-700 mb-2">Patient</label>
                                    <select id="medication-patient" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                        <option value="">Select Patient</option>
                                        <!-- Will be populated by JS -->
                                    </select>
                                </div>
                                <div>
                                    <label for="medication-doctor" class="block text-gray-700 mb-2">Prescribed By</label>
                                    <select id="medication-doctor" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                        <option value="">Select Doctor</option>
                                        <!-- Will be populated by JS -->
                                    </select>
                                </div>
                                <div>
                                    <label for="medication-dosage" class="block text-gray-700 mb-2">Dosage</label>
                                    <input type="text" id="medication-dosage" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label for="medication-frequency" class="block text-gray-700 mb-2">Frequency</label>
                                    <input type="text" id="medication-frequency" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label for="medication-start-date" class="block text-gray-700 mb-2">Start Date</label>
                                    <input type="date" id="medication-start-date" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label for="medication-end-date" class="block text-gray-700 mb-2">End Date</label>
                                    <input type="date" id="medication-end-date" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div class="md:col-span-2 flex justify-end space-x-3">
                                    <button type="button" onclick="hideMedicationForm()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">Cancel</button>
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Save Medication</button>
                                </div>
                            </form>
                        </div>

                        <!-- Medications Table -->
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <div class="p-4 border-b flex justify-between items-center">
                                <div class="flex items-center">
                                    <input type="text" id="medication-search" placeholder="Search medications..." class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <button onclick="refreshMedications()" class="text-gray-600 hover:text-blue-600">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Medication</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prescribed By</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dosage</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="medications-table" class="bg-white divide-y divide-gray-200">
                                        <!-- Will be populated by JS -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="p-4 border-t flex justify-between items-center">
                                <div class="text-sm text-gray-500">
                                    Showing <span id="medication-start">1</span> to <span id="medication-end">10</span> of <span id="medication-total">0</span> medications
                                </div>
                                <div class="flex space-x-2">
                                    <button id="medication-prev" onclick="prevMedicationPage()" class="px-3 py-1 border rounded-lg text-gray-700 disabled:opacity-50" disabled>Previous</button>
                                    <button id="medication-next" onclick="nextMedicationPage()" class="px-3 py-1 border rounded-lg text-gray-700 disabled:opacity-50" disabled>Next</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Billing content will be loaded here -->
                    <div id="billing-content" class="hidden">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-800">Billing Management</h2>
                            <button onclick="showBillingForm()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                                <i class="fas fa-plus mr-2"></i> Add Bill
                            </button>
                        </div>

                        <!-- Billing Form -->
                        <div id="billing-form-container" class="bg-white rounded-lg shadow p-6 mb-6 hidden">
                            <h3 class="text-lg font-semibold mb-4" id="billing-form-title">Add New Bill</h3>
                            <form id="billing-form" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="hidden" id="billing-id">
                                <div>
                                    <label for="billing-patient" class="block text-gray-700 mb-2">Patient</label>
                                    <select id="billing-patient" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                        <option value="">Select Patient</option>
                                        <!-- Will be populated by JS -->
                                    </select>
                                </div>
                                <div>
                                    <label for="billing-date" class="block text-gray-700 mb-2">Date</label>
                                    <input type="date" id="billing-date" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label for="billing-amount" class="block text-gray-700 mb-2">Amount ($)</label>
                                    <input type="number" id="billing-amount" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label for="billing-status" class="block text-gray-700 mb-2">Status</label>
                                    <select id="billing-status" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                        <option value="Pending">Pending</option>
                                        <option value="Paid">Paid</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                </div>
                                <div class="md:col-span-2">
                                    <label for="billing-description" class="block text-gray-700 mb-2">Description</label>
                                    <textarea id="billing-description" rows="3" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                                </div>
                                <div class="md:col-span-2 flex justify-end space-x-3">
                                    <button type="button" onclick="hideBillingForm()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">Cancel</button>
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Save Bill</button>
                                </div>
                            </form>
                        </div>

                        <!-- Billing Table -->
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <div class="p-4 border-b flex justify-between items-center">
                                <div class="flex items-center">
                                    <input type="text" id="billing-search" placeholder="Search bills..." class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <button onclick="refreshBilling()" class="text-gray-600 hover:text-blue-600">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="billing-table" class="bg-white divide-y divide-gray-200">
                                        <!-- Will be populated by JS -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="p-4 border-t flex justify-between items-center">
                                <div class="text-sm text-gray-500">
                                    Showing <span id="billing-start">1</span> to <span id="billing-end">10</span> of <span id="billing-total">0</span> bills
                                </div>
                                <div class="flex space-x-2">
                                    <button id="billing-prev" onclick="prevBillingPage()" class="px-3 py-1 border rounded-lg text-gray-700 disabled:opacity-50" disabled>Previous</button>
                                    <button id="billing-next" onclick="nextBillingPage()" class="px-3 py-1 border rounded-lg text-gray-700 disabled:opacity-50" disabled>Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmation-modal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold" id="modal-title">Confirm Action</h3>
                <button onclick="hideModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <p id="modal-message">Are you sure you want to perform this action?</p>
            <div class="flex justify-end space-x-3 mt-6">
                <button onclick="hideModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">Cancel</button>
                <button id="modal-confirm-btn" onclick="confirmAction()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Confirm</button>
            </div>
        </div>
    </div>

    <script>
        // Global variables
        let currentSection = 'dashboard';
        let currentPatientPage = 1;
        let currentDoctorPage = 1;
        let currentNursePage = 1;
        let currentAppointmentPage = 1;
        let currentWardPage = 1;
        let currentTreatmentPage = 1;
        let currentMedicationPage = 1;
        let currentBillingPage = 1;
        const itemsPerPage = 10;
        let modalAction = null;
        let modalData = null;

        // Initialize the application
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all data
            initData();
            
            // Load dashboard by default
            loadSection('dashboard');
            
            // Set up event listeners
            setupEventListeners();
            
            // Update dashboard stats
            updateDashboardStats();
        });

        // Initialize data in local storage if not exists
        function initData() {
            if (!localStorage.getItem('patients')) {
                localStorage.setItem('patients', JSON.stringify([]));
            }
            if (!localStorage.getItem('doctors')) {
                localStorage.setItem('doctors', JSON.stringify([]));
            }
            if (!localStorage.getItem('nurses')) {
                localStorage.setItem('nurses', JSON.stringify([]));
            }
            if (!localStorage.getItem('appointments')) {
                localStorage.setItem('appointments', JSON.stringify([]));
            }
            if (!localStorage.getItem('wards')) {
                localStorage.setItem('wards', JSON.stringify([]));
            }
            if (!localStorage.getItem('treatments')) {
                localStorage.setItem('treatments', JSON.stringify([]));
            }
            if (!localStorage.getItem('medications')) {
                localStorage.setItem('medications', JSON.stringify([]));
            }
            if (!localStorage.getItem('billing')) {
                localStorage.setItem('billing', JSON.stringify([]));
            }
        }

        // Set up all event listeners
        function setupEventListeners() {
            // Patient form
            document.getElementById('patient-form').addEventListener('submit', function(e) {
                e.preventDefault();
                savePatient();
            });

            // Doctor form
            document.getElementById('doctor-form').addEventListener('submit', function(e) {
                e.preventDefault();
                saveDoctor();
            });

            // Nurse form
            document.getElementById('nurse-form').addEventListener('submit', function(e) {
                e.preventDefault();
                saveNurse();
            });

            // Appointment form
            document.getElementById('appointment-form').addEventListener('submit', function(e) {
                e.preventDefault();
                saveAppointment();
            });

            // Ward form
            document.getElementById('ward-form').addEventListener('submit', function(e) {
                e.preventDefault();
                saveWard();
            });

            // Treatment form
            document.getElementById('treatment-form').addEventListener('submit', function(e) {
                e.preventDefault();
                saveTreatment();
            });

            // Medication form
            document.getElementById('medication-form').addEventListener('submit', function(e) {
                e.preventDefault();
                saveMedication();
            });

            // Billing form
            document.getElementById('billing-form').addEventListener('submit', function(e) {
                e.preventDefault();
                saveBilling();
            });

            // Search functionality
            document.getElementById('patient-search').addEventListener('input', function() {
                filterPatients(this.value);
            });

            document.getElementById('doctor-search').addEventListener('input', function() {
                filterDoctors(this.value);
            });

            document.getElementById('nurse-search').addEventListener('input', function() {
                filterNurses(this.value);
            });

            document.getElementById('appointment-search').addEventListener('input', function() {
                filterAppointments(this.value);
            });

            document.getElementById('ward-search').addEventListener('input', function() {
                filterWards(this.value);
            });

            document.getElementById('treatment-search').addEventListener('input', function() {
                filterTreatments(this.value);
            });

            document.getElementById('medication-search').addEventListener('input', function() {
                filterMedications(this.value);
            });

            document.getElementById('billing-search').addEventListener('input', function() {
                filterBilling(this.value);
            });
        }

        // Toggle sidebar
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('collapsed');
        }

        // Load a section
        function loadSection(section) {
            // Hide all sections
            document.getElementById('dashboard-content').classList.add('hidden');
            document.getElementById('patients-content').classList.add('hidden');
            document.getElementById('doctors-content').classList.add('hidden');
            document.getElementById('nurses-content').classList.add('hidden');
            document.getElementById('appointments-content').classList.add('hidden');
            document.getElementById('wards-content').classList.add('hidden');
            document.getElementById('treatments-content').classList.add('hidden');
            document.getElementById('medications-content').classList.add('hidden');
            document.getElementById('billing-content').classList.add('hidden');

            // Remove active class from all nav items
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active-nav');
            });

            // Show the selected section
            document.getElementById(`${section}-content`).classList.remove('hidden');
            
            // Add active class to the selected nav item
            const navItems = document.querySelectorAll('.nav-item');
            let found = false;
            navItems.forEach(item => {
                const navText = item.querySelector('.nav-text').textContent.toLowerCase();
                if (navText === section) {
                    item.classList.add('active-nav');
                    found = true;
                }
            });

            // If not found (dashboard case)
            if (!found && section === 'dashboard') {
                navItems[0].classList.add('active-nav');
            }

            // Update page title
            const titleMap = {
                'dashboard': 'Dashboard',
                'patients': 'Patient Management',
                'doctors': 'Doctor Management',
                'nurses': 'Nurse Management',
                'appointments': 'Appointment Management',
                'wards': 'Ward Management',
                'treatments': 'Treatment Management',
                'medications': 'Medication Management',
                'billing': 'Billing Management'
            };
            document.getElementById('page-title').textContent = titleMap[section];

            // Load data for the section
            switch(section) {
                case 'dashboard':
                    updateDashboardStats();
                    loadRecentAppointments();
                    loadRecentPatients();
                    break;
                case 'patients':
                    loadPatients();
                    break;
                case 'doctors':
                    loadDoctors();
                    break;
                case 'nurses':
                    loadNurses();
                    break;
                case 'appointments':
                    loadAppointments();
                    populatePatientDoctorDropdowns();
                    break;
                case 'wards':
                    loadWards();
                    break;
                case 'treatments':
                    loadTreatments();
                    populatePatientDoctorDropdowns('treatment');
                    break;
                case 'medications':
                    loadMedications();
                    populatePatientDoctorDropdowns('medication');
                    break;
                case 'billing':
                    loadBilling();
                    populatePatientDropdown('billing');
                    break;
            }

            // Update current section
            currentSection = section;

            // Add fade-in effect
            const contentArea = document.getElementById('content-area');
            contentArea.classList.remove('fade-in');
            void contentArea.offsetWidth; // Trigger reflow
            contentArea.classList.add('fade-in');
        }

        // Show modal
        function showModal(title, message, action, data = null) {
            document.getElementById('modal-title').textContent = title;
            document.getElementById('modal-message').textContent = message;
            document.getElementById('modal-confirm-btn').textContent = action === 'delete' ? 'Delete' : 'Confirm';
            document.getElementById('modal-confirm-btn').className = action === 'delete' ? 
                'bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg' : 
                'bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg';
            
            modalAction = action;
            modalData = data;
            
            document.getElementById('confirmation-modal').classList.add('active');
        }

        // Hide modal
        function hideModal() {
            document.getElementById('confirmation-modal').classList.remove('active');
        }

        // Confirm action in modal
        function confirmAction() {
            if (modalAction === 'delete') {
                if (modalData.type === 'patient') {
                    deletePatient(modalData.id);
                } else if (modalData.type === 'doctor') {
                    deleteDoctor(modalData.id);
                } else if (modalData.type === 'nurse') {
                    deleteNurse(modalData.id);
                } else if (modalData.type === 'appointment') {
                    deleteAppointment(modalData.id);
                } else if (modalData.type === 'ward') {
                    deleteWard(modalData.id);
                } else if (modalData.type === 'treatment') {
                    deleteTreatment(modalData.id);
                } else if (modalData.type === 'medication') {
                    deleteMedication(modalData.id);
                } else if (modalData.type === 'billing') {
                    deleteBilling(modalData.id);
                }
            }
            hideModal();
        }

        // Logout function
        function logout() {
            // In a real app, this would redirect to login page
            alert('Logging out...');
        }

        // Update dashboard statistics
        function updateDashboardStats() {
            const patients = JSON.parse(localStorage.getItem('patients')) || [];
            const doctors = JSON.parse(localStorage.getItem('doctors')) || [];
            const appointments = JSON.parse(localStorage.getItem('appointments')) || [];
            const wards = JSON.parse(localStorage.getItem('wards')) || [];
            
            document.getElementById('total-patients').textContent = patients.length;
            document.getElementById('total-doctors').textContent = doctors.length;
            
            // Count today's appointments
            const today = new Date().toISOString().split('T')[0];
            const todaysAppointments = appointments.filter(app => app.date === today);
            document.getElementById('total-appointments').textContent = todaysAppointments.length;
            
            // Count available wards
            const availableWards = wards.filter(ward => ward.status === 'Available');
            document.getElementById('total-wards').textContent = availableWards.length;
        }

        // Load recent appointments for dashboard
        function loadRecentAppointments() {
            const appointments = JSON.parse(localStorage.getItem('appointments')) || [];
            const patients = JSON.parse(localStorage.getItem('patients')) || [];
            const doctors = JSON.parse(localStorage.getItem('doctors')) || [];
            
            // Sort by date (newest first) and get top 5
            const recentAppointments = [...appointments]
                .sort((a, b) => new Date(b.date) - new Date(a.date))
                .slice(0, 5);
            
            const tbody = document.getElementById('recent-appointments');
            tbody.innerHTML = '';
            
            recentAppointments.forEach(app => {
                const patient = patients.find(p => p.id === app.patientId) || { name: 'Unknown' };
                const doctor = doctors.find(d => d.id === app.doctorId) || { name: 'Unknown' };
                
                const tr = document.createElement('tr');
                tr.className = 'text-sm';
                tr.innerHTML = `
                    <td class="py-2">${app.id.substring(0, 8)}</td>
                    <td class="py-2">${patient.name}</td>
                    <td class="py-2">${doctor.name}</td>
                    <td class="py-2">${formatDate(app.date)} ${app.time}</td>
                    <td class="py-2">
                        <span class="px-2 py-1 rounded-full text-xs ${getStatusClass(app.status)}">
                            ${app.status}
                        </span>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        // Load recent patients for dashboard
        function loadRecentPatients() {
            const patients = JSON.parse(localStorage.getItem('patients')) || [];
            
            // Sort by date (newest first) and get top 5
            const recentPatients = [...patients]
                .sort((a, b) => new Date(b.createdAt || 0) - new Date(a.createdAt || 0))
                .slice(0, 5);
            
            const tbody = document.getElementById('recent-patients');
            tbody.innerHTML = '';
            
            recentPatients.forEach(patient => {
                const tr = document.createElement('tr');
                tr.className = 'text-sm';
                tr.innerHTML = `
                    <td class="py-2">${patient.id.substring(0, 8)}</td>
                    <td class="py-2">${patient.name}</td>
                    <td class="py-2">${patient.gender}</td>
                    <td class="py-2">${patient.phone}</td>
                    <td class="py-2">
                        <button onclick="editPatient('${patient.id}')" class="text-blue-600 hover:text-blue-800 mr-2">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="showModal('Delete Patient', 'Are you sure you want to delete this patient?', 'delete', { type: 'patient', id: '${patient.id}' })" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        // Format date for display
        function formatDate(dateString) {
            if (!dateString) return '';
            const options = { year: 'numeric', month: 'short', day: 'numeric' };
            return new Date(dateString).toLocaleDateString(undefined, options);
        }

        // Get status class for styling
        function getStatusClass(status) {
            switch(status) {
                case 'Scheduled': return 'bg-blue-100 text-blue-800';
                case 'Completed': return 'bg-green-100 text-green-800';
                case 'Cancelled': return 'bg-red-100 text-red-800';
                case 'Pending': return 'bg-yellow-100 text-yellow-800';
                case 'Paid': return 'bg-green-100 text-green-800';
                default: return 'bg-gray-100 text-gray-800';
            }
        }

        // ==================== PATIENT FUNCTIONS ====================
        function showPatientForm() {
            document.getElementById('patient-form-container').classList.remove('hidden');
            document.getElementById('patient-form-title').textContent = 'Add New Patient';
            document.getElementById('patient-form').reset();
            document.getElementById('patient-id').value = '';
        }

        function hidePatientForm() {
            document.getElementById('patient-form-container').classList.add('hidden');
        }

        
        function loadPatients() {
            const patients = JSON.parse(localStorage.getItem('patients')) || [];
            const searchTerm = document.getElementById('patient-search').value.toLowerCase();
            
            // Filter patients if search term exists
            let filteredPatients = patients;
            if (searchTerm) {
                filteredPatients = patients.filter(patient => 
                    patient.name.toLowerCase().includes(searchTerm) ||
                    patient.phone.toLowerCase().includes(searchTerm) ||
                    (patient.address && patient.address.toLowerCase().includes(searchTerm))
                );
            }
            
            // Pagination
            const startIndex = (currentPatientPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedPatients = filteredPatients.slice(startIndex, endIndex);
            
            const tbody = document.getElementById('patients-table');
            tbody.innerHTML = '';
            
            if (paginatedPatients.length === 0) {
                const tr = document.createElement('tr');
                tr.innerHTML = `<td colspan="7" class="px-6 py-4 text-center text-gray-500">No patients found</td>`;
                tbody.appendChild(tr);
            } else {
                paginatedPatients.forEach(patient => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap">${patient.id.substring(0, 8)}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${patient.name}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${patient.gender}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${formatDate(patient.dob)}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${patient.phone}</td>
                        <td class="px-6 py-4">${patient.address || '-'}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button onclick="editPatient('${patient.id}')" class="text-blue-600 hover:text-blue-800 mr-2">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="showModal('Delete Patient', 'Are you sure you want to delete this patient?', 'delete', { type: 'patient', id: '${patient.id}' })" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            }
            
            // Update pagination info
            document.getElementById('patient-start').textContent = filteredPatients.length > 0 ? startIndex + 1 : 0;
            document.getElementById('patient-end').textContent = Math.min(endIndex, filteredPatients.length);
            document.getElementById('patient-total').textContent = filteredPatients.length;
            
            // Update pagination buttons
            document.getElementById('patient-prev').disabled = currentPatientPage === 1;
            document.getElementById('patient-next').disabled = endIndex >= filteredPatients.length;
        }

        function editPatient(id) {
            const patients = JSON.parse(localStorage.getItem('patients')) || [];
            const patient = patients.find(p => p.id === id);
            
            if (patient) {
                document.getElementById('patient-id').value = patient.id;
                document.getElementById('patient-name').value = patient.name;
                document.getElementById('patient-gender').value = patient.gender;
                document.getElementById('patient-dob').value = patient.dob;
                document.getElementById('patient-phone').value = patient.phone;
                document.getElementById('patient-address').value = patient.address || '';
                
                document.getElementById('patient-form-title').textContent = 'Edit Patient';
                document.getElementById('patient-form-container').classList.remove('hidden');
            }
        }

        function deletePatient(id) {
            let patients = JSON.parse(localStorage.getItem('patients')) || [];
            patients = patients.filter(p => p.id !== id);
            localStorage.setItem('patients', JSON.stringify(patients));
            
            loadPatients();
            updateDashboardStats();
            loadRecentPatients();
        }

        function filterPatients(searchTerm) {
            currentPatientPage = 1;
            loadPatients();
        }

        function prevPatientPage() {
            if (currentPatientPage > 1) {
                currentPatientPage--;
                loadPatients();
            }
        }

        function nextPatientPage() {
            const patients = JSON.parse(localStorage.getItem('patients')) || [];
            const searchTerm = document.getElementById('patient-search').value.toLowerCase();
            let filteredPatients = patients;
            
            if (searchTerm) {
                filteredPatients = patients.filter(patient => 
                    patient.name.toLowerCase().includes(searchTerm) ||
                    patient.phone.toLowerCase().includes(searchTerm) ||
                    (patient.address && patient.address.toLowerCase().includes(searchTerm))
                );
            }
            
            if (currentPatientPage * itemsPerPage < filteredPatients.length) {
                currentPatientPage++;
                loadPatients();
            }
        }

        function refreshPatients() {
            document.getElementById('patient-search').value = '';
            currentPatientPage = 1;
            loadPatients();
        }

        // ==================== DOCTOR FUNCTIONS ====================
        function showDoctorForm() {
            document.getElementById('doctor-form-container').classList.remove('hidden');
            document.getElementById('doctor-form-title').textContent = 'Add New Doctor';
            document.getElementById('doctor-form').reset();
            document.getElementById('doctor-id').value = '';
        }

        function hideDoctorForm() {
            document.getElementById('doctor-form-container').classList.add('hidden');
        }

        function saveDoctor() {
            const id = document.getElementById('doctor-id').value;
            const name = document.getElementById('doctor-name').value;
            const specialization = document.getElementById('doctor-specialization').value;
            const email = document.getElementById('doctor-email').value;
            const phone = document.getElementById('doctor-phone').value;
            
            const doctors = JSON.parse(localStorage.getItem('doctors')) || [];
            
            if (id) {
                // Update existing doctor
                const index = doctors.findIndex(d => d.id === id);
                if (index !== -1) {
                    doctors[index] = { id, name, specialization, email, phone };
                }
            } else {
                // Add new doctor
                const newId = generateId();
                doctors.push({ id: newId, name, specialization, email, phone });
            }
            
            localStorage.setItem('doctors', JSON.stringify(doctors));
            hideDoctorForm();
            loadDoctors();
            updateDashboardStats();
            populatePatientDoctorDropdowns();
        }

        function loadDoctors() {
            const doctors = JSON.parse(localStorage.getItem('doctors')) || [];
            const searchTerm = document.getElementById('doctor-search').value.toLowerCase();
            
            // Filter doctors if search term exists
            let filteredDoctors = doctors;
            if (searchTerm) {
                filteredDoctors = doctors.filter(doctor => 
                    doctor.name.toLowerCase().includes(searchTerm) ||
                    doctor.specialization.toLowerCase().includes(searchTerm) ||
                    doctor.email.toLowerCase().includes(searchTerm) ||
                    doctor.phone.toLowerCase().includes(searchTerm)
                );
            }
            
            // Pagination
            const startIndex = (currentDoctorPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedDoctors = filteredDoctors.slice(startIndex, endIndex);
            
            const tbody = document.getElementById('doctors-table');
            tbody.innerHTML = '';
            
            if (paginatedDoctors.length === 0) {
                const tr = document.createElement('tr');
                tr.innerHTML = `<td colspan="6" class="px-6 py-4 text-center text-gray-500">No doctors found</td>`;
                tbody.appendChild(tr);
            } else {
                paginatedDoctors.forEach(doctor => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap">${doctor.id.substring(0, 8)}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${doctor.name}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${doctor.specialization}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${doctor.email}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${doctor.phone}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button onclick="editDoctor('${doctor.id}')" class="text-blue-600 hover:text-blue-800 mr-2">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="showModal('Delete Doctor', 'Are you sure you want to delete this doctor?', 'delete', { type: 'doctor', id: '${doctor.id}' })" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            }
            
            // Update pagination info
            document.getElementById('doctor-start').textContent = filteredDoctors.length > 0 ? startIndex + 1 : 0;
            document.getElementById('doctor-end').textContent = Math.min(endIndex, filteredDoctors.length);
            document.getElementById('doctor-total').textContent = filteredDoctors.length;
            
            // Update pagination buttons
            document.getElementById('doctor-prev').disabled = currentDoctorPage === 1;
            document.getElementById('doctor-next').disabled = endIndex >= filteredDoctors.length;
        }

        function editDoctor(id) {
            const doctors = JSON.parse(localStorage.getItem('doctors')) || [];
            const doctor = doctors.find(d => d.id === id);
            
            if (doctor) {
                document.getElementById('doctor-id').value = doctor.id;
                document.getElementById('doctor-name').value = doctor.name;
                document.getElementById('doctor-specialization').value = doctor.specialization;
                document.getElementById('doctor-email').value = doctor.email;
                document.getElementById('doctor-phone').value = doctor.phone;
                
                document.getElementById('doctor-form-title').textContent = 'Edit Doctor';
                document.getElementById('doctor-form-container').classList.remove('hidden');
            }
        }

        function deleteDoctor(id) {
            let doctors = JSON.parse(localStorage.getItem('doctors')) || [];
            doctors = doctors.filter(d => d.id !== id);
            localStorage.setItem('doctors', JSON.stringify(doctors));
            
            loadDoctors();
            updateDashboardStats();
            populatePatientDoctorDropdowns();
        }

        function filterDoctors(searchTerm) {
            currentDoctorPage = 1;
            loadDoctors();
        }

        function prevDoctorPage() {
            if (currentDoctorPage > 1) {
                currentDoctorPage--;
                loadDoctors();
            }
        }

        function nextDoctorPage() {
            const doctors = JSON.parse(localStorage.getItem('doctors')) || [];
            const searchTerm = document.getElementById('doctor-search').value.toLowerCase();
            let filteredDoctors = doctors;
            
            if (searchTerm) {
                filteredDoctors = doctors.filter(doctor => 
                    doctor.name.toLowerCase().includes(searchTerm) ||
                    doctor.specialization.toLowerCase().includes(searchTerm) ||
                    doctor.email.toLowerCase().includes(searchTerm) ||
                    doctor.phone.toLowerCase().includes(searchTerm)
                );
            }
            
            if (currentDoctorPage * itemsPerPage < filteredDoctors.length) {
                currentDoctorPage++;
                loadDoctors();
            }
        }

        function refreshDoctors() {
            document.getElementById('doctor-search').value = '';
            currentDoctorPage = 1;
            loadDoctors();
        }

        // ==================== NURSE FUNCTIONS ====================
        function showNurseForm() {
            document.getElementById('nurse-form-container').classList.remove('hidden');
            document.getElementById('nurse-form-title').textContent = 'Add New Nurse';
            document.getElementById('nurse-form').reset();
            document.getElementById('nurse-id').value = '';
        }

        function hideNurseForm() {
            document.getElementById('nurse-form-container').classList.add('hidden');
        }

        function saveNurse() {
            const id = document.getElementById('nurse-id').value;
            const name = document.getElementById('nurse-name').value;
            const ward = document.getElementById('nurse-ward').value;
            const email = document.getElementById('nurse-email').value;
            const phone = document.getElementById('nurse-phone').value;
            
            const nurses = JSON.parse(localStorage.getItem('nurses')) || [];
            
            if (id) {
                // Update existing nurse
                const index = nurses.findIndex(n => n.id === id);
                if (index !== -1) {
                    nurses[index] = { id, name, ward, email, phone };
                }
            } else {
                // Add new nurse
                const newId = generateId();
                nurses.push({ id: newId, name, ward, email, phone });
            }
            
            localStorage.setItem('nurses', JSON.stringify(nurses));
            hideNurseForm();
            loadNurses();
            updateDashboardStats();
        }

        function loadNurses() {
            const nurses = JSON.parse(localStorage.getItem('nurses')) || [];
            const searchTerm = document.getElementById('nurse-search').value.toLowerCase();
            
            // Filter nurses if search term exists
            let filteredNurses = nurses;
            if (searchTerm) {
                filteredNurses = nurses.filter(nurse => 
                    nurse.name.toLowerCase().includes(searchTerm) ||
                    nurse.ward.toLowerCase().includes(searchTerm) ||
                    nurse.email.toLowerCase().includes(searchTerm) ||
                    nurse.phone.toLowerCase().includes(searchTerm)
                );
            }
            
            // Pagination
            const startIndex = (currentNursePage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedNurses = filteredNurses.slice(startIndex, endIndex);
            
            const tbody = document.getElementById('nurses-table');
            tbody.innerHTML = '';
            
            if (paginatedNurses.length === 0) {
                const tr = document.createElement('tr');
                tr.innerHTML = `<td colspan="6" class="px-6 py-4 text-center text-gray-500">No nurses found</td>`;
                tbody.appendChild(tr);
            } else {
                paginatedNurses.forEach(nurse => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap">${nurse.id.substring(0, 8)}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${nurse.name}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${nurse.ward}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${nurse.email}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${nurse.phone}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button onclick="editNurse('${nurse.id}')" class="text-blue-600 hover:text-blue-800 mr-2">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="showModal('Delete Nurse', 'Are you sure you want to delete this nurse?', 'delete', { type: 'nurse', id: '${nurse.id}' })" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            }
            
            // Update pagination info
            document.getElementById('nurse-start').textContent = filteredNurses.length > 0 ? startIndex + 1 : 0;
            document.getElementById('nurse-end').textContent = Math.min(endIndex, filteredNurses.length);
            document.getElementById('nurse-total').textContent = filteredNurses.length;
            
            // Update pagination buttons
            document.getElementById('nurse-prev').disabled = currentNursePage === 1;
            document.getElementById('nurse-next').disabled = endIndex >= filteredNurses.length;
        }

        function editNurse(id) {
            const nurses = JSON.parse(localStorage.getItem('nurses')) || [];
            const nurse = nurses.find(n => n.id === id);
            
            if (nurse) {
                document.getElementById('nurse-id').value = nurse.id;
                document.getElementById('nurse-name').value = nurse.name;
                document.getElementById('nurse-ward').value = nurse.ward;
                document.getElementById('nurse-email').value = nurse.email;
                document.getElementById('nurse-phone').value = nurse.phone;
                
                document.getElementById('nurse-form-title').textContent = 'Edit Nurse';
                document.getElementById('nurse-form-container').classList.remove('hidden');
            }
        }

        function deleteNurse(id) {
            let nurses = JSON.parse(localStorage.getItem('nurses')) || [];
            nurses = nurses.filter(n => n.id !== id);
            localStorage.setItem('nurses', JSON.stringify(nurses));
            
            loadNurses();
            updateDashboardStats();
        }

        function filterNurses(searchTerm) {
            currentNursePage = 1;
            loadNurses();
        }

        function prevNursePage() {
            if (currentNursePage > 1) {
                currentNursePage--;
                loadNurses();
            }
        }

        function nextNursePage() {
            const nurses = JSON.parse(localStorage.getItem('nurses')) || [];
            const searchTerm = document.getElementById('nurse-search').value.toLowerCase();
            let filteredNurses = nurses;
            
            if (searchTerm) {
                filteredNurses = nurses.filter(nurse => 
                    nurse.name.toLowerCase().includes(searchTerm) ||
                    nurse.ward.toLowerCase().includes(searchTerm) ||
                    nurse.email.toLowerCase().includes(searchTerm) ||
                    nurse.phone.toLowerCase().includes(searchTerm)
                );
            }
            
            if (currentNursePage * itemsPerPage < filteredNurses.length) {
                currentNursePage++;
                loadNurses();
            }
        }

        function refreshNurses() {
            document.getElementById('nurse-search').value = '';
            currentNursePage = 1;
            loadNurses();
        }

        // ==================== APPOINTMENT FUNCTIONS ====================
        function showAppointmentForm() {
            document.getElementById('appointment-form-container').classList.remove('hidden');
            document.getElementById('appointment-form-title').textContent = 'Schedule New Appointment';
            document.getElementById('appointment-form').reset();
            document.getElementById('appointment-id').value = '';
            
            // Set default date to today
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('appointment-date').value = today;
            
            // Set default time to next hour
            const nextHour = new Date();
            nextHour.setHours(nextHour.getHours() + 1);
            const hours = nextHour.getHours().toString().padStart(2, '0');
            const minutes = nextHour.getMinutes().toString().padStart(2, '0');
            document.getElementById('appointment-time').value = `${hours}:${minutes}`;
        }

        function hideAppointmentForm() {
            document.getElementById('appointment-form-container').classList.add('hidden');
        }

        function saveAppointment() {
            const id = document.getElementById('appointment-id').value;
            const patientId = document.getElementById('appointment-patient').value;
            const doctorId = document.getElementById('appointment-doctor').value;
            const date = document.getElementById('appointment-date').value;
            const time = document.getElementById('appointment-time').value;
            const status = document.getElementById('appointment-status').value;
            
            const appointments = JSON.parse(localStorage.getItem('appointments')) || [];
            const patients = JSON.parse(localStorage.getItem('patients')) || [];
            const doctors = JSON.parse(localStorage.getItem('doctors')) || [];
            
            const patient = patients.find(p => p.id === patientId);
            const doctor = doctors.find(d => d.id === doctorId);
            
            if (!patient || !doctor) {
                alert('Invalid patient or doctor selected');
                return;
            }
            
            if (id) {
                // Update existing appointment
                const index = appointments.findIndex(a => a.id === id);
                if (index !== -1) {
                    appointments[index] = { 
                        id, 
                        patientId, 
                        doctorId, 
                        patientName: patient.name,
                        doctorName: doctor.name,
                        date, 
                        time, 
                        status 
                    };
                }
            } else {
                // Add new appointment
                const newId = generateId();
                appointments.push({ 
                    id: newId, 
                    patientId, 
                    doctorId,
                    patientName: patient.name,
                    doctorName: doctor.name,
                    date, 
                    time, 
                    status,
                    createdAt: new Date().toISOString()
                });
            }
            
            localStorage.setItem('appointments', JSON.stringify(appointments));
            hideAppointmentForm();
            loadAppointments();
            updateDashboardStats();
            loadRecentAppointments();
        }

        function loadAppointments() {
            const appointments = JSON.parse(localStorage.getItem('appointments')) || [];
            const searchTerm = document.getElementById('appointment-search').value.toLowerCase();
            
            // Filter appointments if search term exists
            let filteredAppointments = appointments;
            if (searchTerm) {
                filteredAppointments = appointments.filter(app => 
                    app.patientName.toLowerCase().includes(searchTerm) ||
                    app.doctorName.toLowerCase().includes(searchTerm) ||
                    app.date.toLowerCase().includes(searchTerm) ||
                    app.status.toLowerCase().includes(searchTerm)
                );
            }
            
            // Sort by date (newest first)
            filteredAppointments.sort((a, b) => new Date(b.date) - new Date(a.date));
            
            // Pagination
            const startIndex = (currentAppointmentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedAppointments = filteredAppointments.slice(startIndex, endIndex);
            
            const tbody = document.getElementById('appointments-table');
            tbody.innerHTML = '';
            
            if (paginatedAppointments.length === 0) {
                const tr = document.createElement('tr');
                tr.innerHTML = `<td colspan="6" class="px-6 py-4 text-center text-gray-500">No appointments found</td>`;
                tbody.appendChild(tr);
            } else {
                paginatedAppointments.forEach(app => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap">${app.id.substring(0, 8)}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${app.patientName}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${app.doctorName}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${formatDate(app.date)} ${app.time}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 rounded-full text-xs ${getStatusClass(app.status)}">
                                ${app.status}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button onclick="editAppointment('${app.id}')" class="text-blue-600 hover:text-blue-800 mr-2">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="showModal('Delete Appointment', 'Are you sure you want to delete this appointment?', 'delete', { type: 'appointment', id: '${app.id}' })" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            }
            
            // Update pagination info
            document.getElementById('appointment-start').textContent = filteredAppointments.length > 0 ? startIndex + 1 : 0;
            document.getElementById('appointment-end').textContent = Math.min(endIndex, filteredAppointments.length);
            document.getElementById('appointment-total').textContent = filteredAppointments.length;
            
            // Update pagination buttons
            document.getElementById('appointment-prev').disabled = currentAppointmentPage === 1;
            document.getElementById('appointment-next').disabled = endIndex >= filteredAppointments.length;
        }

        function editAppointment(id) {
            const appointments = JSON.parse(localStorage.getItem('appointments')) || [];
            const appointment = appointments.find(a => a.id === id);
            
            if (appointment) {
                document.getElementById('appointment-id').value = appointment.id;
                document.getElementById('appointment-patient').value = appointment.patientId;
                document.getElementById('appointment-doctor').value = appointment.doctorId;
                document.getElementById('appointment-date').value = appointment.date;
                document.getElementById('appointment-time').value = appointment.time;
                document.getElementById('appointment-status').value = appointment.status;
                
                document.getElementById('appointment-form-title').textContent = 'Edit Appointment';
                document.getElementById('appointment-form-container').classList.remove('hidden');
            }
        }

        function deleteAppointment(id) {
            let appointments = JSON.parse(localStorage.getItem('appointments')) || [];
            appointments = appointments.filter(a => a.id !== id);
            localStorage.setItem('appointments', JSON.stringify(appointments));
            
            loadAppointments();
            updateDashboardStats();
            loadRecentAppointments();
        }

        function filterAppointments(searchTerm) {
            currentAppointmentPage = 1;
            loadAppointments();
        }

        function prevAppointmentPage() {
            if (currentAppointmentPage > 1) {
                currentAppointmentPage--;
                loadAppointments();
            }
        }

        function nextAppointmentPage() {
            const appointments = JSON.parse(localStorage.getItem('appointments')) || [];
            const searchTerm = document.getElementById('appointment-search').value.toLowerCase();
            let filteredAppointments = appointments;
            
            if (searchTerm) {
                filteredAppointments = appointments.filter(app => 
                    app.patientName.toLowerCase().includes(searchTerm) ||
                    app.doctorName.toLowerCase().includes(searchTerm) ||
                    app.date.toLowerCase().includes(searchTerm) ||
                    app.status.toLowerCase().includes(searchTerm)
                );
            }
            
            if (currentAppointmentPage * itemsPerPage < filteredAppointments.length) {
                currentAppointmentPage++;
                loadAppointments();
            }
        }

        function refreshAppointments() {
            document.getElementById('appointment-search').value = '';
            currentAppointmentPage = 1;
            loadAppointments();
        }

        // ==================== WARD FUNCTIONS ====================
        function showWardForm() {
            document.getElementById('ward-form-container').classList.remove('hidden');
            document.getElementById('ward-form-title').textContent = 'Add New Ward';
            document.getElementById('ward-form').reset();
            document.getElementById('ward-id').value = '';
        }

        function hideWardForm() {
            document.getElementById('ward-form-container').classList.add('hidden');
        }

        function saveWard() {
            const id = document.getElementById('ward-id').value;
            const name = document.getElementById('ward-name').value;
            const type = document.getElementById('ward-type').value;
            const capacity = document.getElementById('ward-capacity').value;
            const status = document.getElementById('ward-status').value;
            
            const wards = JSON.parse(localStorage.getItem('wards')) || [];
            
            if (id) {
                // Update existing ward
                const index = wards.findIndex(w => w.id === id);
                if (index !== -1) {
                    wards[index] = { id, name, type, capacity, status };
                }
            } else {
                // Add new ward
                const newId = generateId();
                wards.push({ id: newId, name, type, capacity, status });
            }
            
            localStorage.setItem('wards', JSON.stringify(wards));
            hideWardForm();
            loadWards();
            updateDashboardStats();
        }

        function loadWards() {
            const wards = JSON.parse(localStorage.getItem('wards')) || [];
            const searchTerm = document.getElementById('ward-search').value.toLowerCase();
            
            // Filter wards if search term exists
            let filteredWards = wards;
            if (searchTerm) {
                filteredWards = wards.filter(ward => 
                    ward.name.toLowerCase().includes(searchTerm) ||
                    ward.type.toLowerCase().includes(searchTerm) ||
                    ward.status.toLowerCase().includes(searchTerm)
                );
            }
            
            // Pagination
            const startIndex = (currentWardPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedWards = filteredWards.slice(startIndex, endIndex);
            
            const tbody = document.getElementById('wards-table');
            tbody.innerHTML = '';
            
            if (paginatedWards.length === 0) {
                const tr = document.createElement('tr');
                tr.innerHTML = `<td colspan="6" class="px-6 py-4 text-center text-gray-500">No wards found</td>`;
                tbody.appendChild(tr);
            } else {
                paginatedWards.forEach(ward => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap">${ward.id.substring(0, 8)}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${ward.name}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${ward.type}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${ward.capacity}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 rounded-full text-xs ${getStatusClass(ward.status)}">
                                ${ward.status}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button onclick="editWard('${ward.id}')" class="text-blue-600 hover:text-blue-800 mr-2">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="showModal('Delete Ward', 'Are you sure you want to delete this ward?', 'delete', { type: 'ward', id: '${ward.id}' })" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            }
            
            // Update pagination info
            document.getElementById('ward-start').textContent = filteredWards.length > 0 ? startIndex + 1 : 0;
            document.getElementById('ward-end').textContent = Math.min(endIndex, filteredWards.length);
            document.getElementById('ward-total').textContent = filteredWards.length;
            
            // Update pagination buttons
            document.getElementById('ward-prev').disabled = currentWardPage === 1;
            document.getElementById('ward-next').disabled = endIndex >= filteredWards.length;
        }

        function editWard(id) {
            const wards = JSON.parse(localStorage.getItem('wards')) || [];
            const ward = wards.find(w => w.id === id);
            
            if (ward) {
                document.getElementById('ward-id').value = ward.id;
                document.getElementById('ward-name').value = ward.name;
                document.getElementById('ward-type').value = ward.type;
                document.getElementById('ward-capacity').value = ward.capacity;
                document.getElementById('ward-status').value = ward.status;
                
                document.getElementById('ward-form-title').textContent = 'Edit Ward';
                document.getElementById('ward-form-container').classList.remove('hidden');
            }
        }

        function deleteWard(id) {
            let wards = JSON.parse(localStorage.getItem('wards')) || [];
            wards = wards.filter(w => w.id !== id);
            localStorage.setItem('wards', JSON.stringify(wards));
            
            loadWards();
            updateDashboardStats();
        }

        function filterWards(searchTerm) {
            currentWardPage = 1;
            loadWards();
        }

        function prevWardPage() {
            if (currentWardPage > 1) {
                currentWardPage--;
                loadWards();
            }
        }

        function nextWardPage() {
            const wards = JSON.parse(localStorage.getItem('wards')) || [];
            const searchTerm = document.getElementById('ward-search').value.toLowerCase();
            let filteredWards = wards;
            
            if (searchTerm) {
                filteredWards = wards.filter(ward => 
                    ward.name.toLowerCase().includes(searchTerm) ||
                    ward.type.toLowerCase().includes(searchTerm) ||
                    ward.status.toLowerCase().includes(searchTerm)
                );
            }
            
            if (currentWardPage * itemsPerPage < filteredWards.length) {
                currentWardPage++;
                loadWards();
            }
        }

        function refreshWards() {
            document.getElementById('ward-search').value = '';
            currentWardPage = 1;
            loadWards();
        }

        // ==================== TREATMENT FUNCTIONS ====================
        function showTreatmentForm() {
            document.getElementById('treatment-form-container').classList.remove('hidden');
            document.getElementById('treatment-form-title').textContent = 'Add New Treatment';
            document.getElementById('treatment-form').reset();
            document.getElementById('treatment-id').value = '';
            
            // Set default date to today
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('treatment-date').value = today;
        }

        function hideTreatmentForm() {
            document.getElementById('treatment-form-container').classList.add('hidden');
        }

        function saveTreatment() {
            const id = document.getElementById('treatment-id').value;
            const name = document.getElementById('treatment-name').value;
            const patientId = document.getElementById('treatment-patient').value;
            const doctorId = document.getElementById('treatment-doctor').value;
            const date = document.getElementById('treatment-date').value;
            const description = document.getElementById('treatment-description').value;
            
            const treatments = JSON.parse(localStorage.getItem('treatments')) || [];
            const patients = JSON.parse(localStorage.getItem('patients')) || [];
            const doctors = JSON.parse(localStorage.getItem('doctors')) || [];
            
            const patient = patients.find(p => p.id === patientId);
            const doctor = doctors.find(d => d.id === doctorId);
            
            if (!patient || !doctor) {
                alert('Invalid patient or doctor selected');
                return;
            }
            
            if (id) {
                // Update existing treatment
                const index = treatments.findIndex(t => t.id === id);
                if (index !== -1) {
                    treatments[index] = { 
                        id, 
                        name,
                        patientId, 
                        doctorId, 
                        patientName: patient.name,
                        doctorName: doctor.name,
                        date, 
                        description 
                    };
                }
            } else {
                // Add new treatment
                const newId = generateId();
                treatments.push({ 
                    id: newId, 
                    name,
                    patientId, 
                    doctorId,
                    patientName: patient.name,
                    doctorName: doctor.name,
                    date, 
                    description,
                    createdAt: new Date().toISOString()
                });
            }
            
            localStorage.setItem('treatments', JSON.stringify(treatments));
            hideTreatmentForm();
            loadTreatments();
        }

        function loadTreatments() {
            const treatments = JSON.parse(localStorage.getItem('treatments')) || [];
            const searchTerm = document.getElementById('treatment-search').value.toLowerCase();
            
            // Filter treatments if search term exists
            let filteredTreatments = treatments;
            if (searchTerm) {
                filteredTreatments = treatments.filter(treatment => 
                    treatment.name.toLowerCase().includes(searchTerm) ||
                    treatment.patientName.toLowerCase().includes(searchTerm) ||
                    treatment.doctorName.toLowerCase().includes(searchTerm) ||
                    treatment.date.toLowerCase().includes(searchTerm) ||
                    treatment.description.toLowerCase().includes(searchTerm)
                );
            }
            
            // Sort by date (newest first)
            filteredTreatments.sort((a, b) => new Date(b.date) - new Date(a.date));
            
            // Pagination
            const startIndex = (currentTreatmentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedTreatments = filteredTreatments.slice(startIndex, endIndex);
            
            const tbody = document.getElementById('treatments-table');
            tbody.innerHTML = '';
            
            if (paginatedTreatments.length === 0) {
                const tr = document.createElement('tr');
                tr.innerHTML = `<td colspan="6" class="px-6 py-4 text-center text-gray-500">No treatments found</td>`;
                tbody.appendChild(tr);
            } else {
                paginatedTreatments.forEach(treatment => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap">${treatment.id.substring(0, 8)}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${treatment.name}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${treatment.patientName}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${treatment.doctorName}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${formatDate(treatment.date)}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button onclick="editTreatment('${treatment.id}')" class="text-blue-600 hover:text-blue-800 mr-2">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="showModal('Delete Treatment', 'Are you sure you want to delete this treatment?', 'delete', { type: 'treatment', id: '${treatment.id}' })" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            }
            
            // Update pagination info
            document.getElementById('treatment-start').textContent = filteredTreatments.length > 0 ? startIndex + 1 : 0;
            document.getElementById('treatment-end').textContent = Math.min(endIndex, filteredTreatments.length);
            document.getElementById('treatment-total').textContent = filteredTreatments.length;
            
            // Update pagination buttons
            document.getElementById('treatment-prev').disabled = currentTreatmentPage === 1;
            document.getElementById('treatment-next').disabled = endIndex >= filteredTreatments.length;
        }

        function editTreatment(id) {
            const treatments = JSON.parse(localStorage.getItem('treatments')) || [];
            const treatment = treatments.find(t => t.id === id);
            
            if (treatment) {
                document.getElementById('treatment-id').value = treatment.id;
                document.getElementById('treatment-name').value = treatment.name;
                document.getElementById('treatment-patient').value = treatment.patientId;
                document.getElementById('treatment-doctor').value = treatment.doctorId;
                document.getElementById('treatment-date').value = treatment.date;
                document.getElementById('treatment-description').value = treatment.description;
                
                document.getElementById('treatment-form-title').textContent = 'Edit Treatment';
                document.getElementById('treatment-form-container').classList.remove('hidden');
            }
        }

        function deleteTreatment(id) {
            let treatments = JSON.parse(localStorage.getItem('treatments')) || [];
            treatments = treatments.filter(t => t.id !== id);
            localStorage.setItem('treatments', JSON.stringify(treatments));
            
            loadTreatments();
        }

        function filterTreatments(searchTerm) {
            currentTreatmentPage = 1;
            loadTreatments();
        }

        function prevTreatmentPage() {
            if (currentTreatmentPage > 1) {
                currentTreatmentPage--;
                loadTreatments();
            }
        }

        function nextTreatmentPage() {
            const treatments = JSON.parse(localStorage.getItem('treatments')) || [];
            const searchTerm = document.getElementById('treatment-search').value.toLowerCase();
            let filteredTreatments = treatments;
            
            if (searchTerm) {
                filteredTreatments = treatments.filter(treatment => 
                    treatment.name.toLowerCase().includes(searchTerm) ||
                    treatment.patientName.toLowerCase().includes(searchTerm) ||
                    treatment.doctorName.toLowerCase().includes(searchTerm) ||
                    treatment.date.toLowerCase().includes(searchTerm) ||
                    treatment.description.toLowerCase().includes(searchTerm)
                );
            }
            
            if (currentTreatmentPage * itemsPerPage < filteredTreatments.length) {
                currentTreatmentPage++;
                loadTreatments();
            }
        }

        function refreshTreatments() {
            document.getElementById('treatment-search').value = '';
            currentTreatmentPage = 1;
            loadTreatments();
        }

        // ==================== MEDICATION FUNCTIONS ====================
        function showMedicationForm() {
            document.getElementById('medication-form-container').classList.remove('hidden');
            document.getElementById('medication-form-title').textContent = 'Add New Medication';
            document.getElementById('medication-form').reset();
            document.getElementById('medication-id').value = '';
            
            // Set default dates
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('medication-start-date').value = today;
            
            const nextWeek = new Date();
            nextWeek.setDate(nextWeek.getDate() + 7);
            document.getElementById('medication-end-date').value = nextWeek.toISOString().split('T')[0];
        }

        function hideMedicationForm() {
            document.getElementById('medication-form-container').classList.add('hidden');
        }

        function saveMedication() {
            const id = document.getElementById('medication-id').value;
            const name = document.getElementById('medication-name').value;
            const patientId = document.getElementById('medication-patient').value;
            const doctorId = document.getElementById('medication-doctor').value;
            const dosage = document.getElementById('medication-dosage').value;
            const frequency = document.getElementById('medication-frequency').value;
            const startDate = document.getElementById('medication-start-date').value;
            const endDate = document.getElementById('medication-end-date').value;
            
            const medications = JSON.parse(localStorage.getItem('medications')) || [];
            const patients = JSON.parse(localStorage.getItem('patients')) || [];
            const doctors = JSON.parse(localStorage.getItem('doctors')) || [];
            
            const patient = patients.find(p => p.id === patientId);
            const doctor = doctors.find(d => d.id === doctorId);
            
            if (!patient || !doctor) {
                alert('Invalid patient or doctor selected');
                return;
            }
            
            if (id) {
                // Update existing medication
                const index = medications.findIndex(m => m.id === id);
                if (index !== -1) {
                    medications[index] = { 
                        id, 
                        name,
                        patientId, 
                        doctorId, 
                        patientName: patient.name,
                        doctorName: doctor.name,
                        dosage, 
                        frequency,
                        startDate,
                        endDate
                    };
                }
            } else {
                // Add new medication
                const newId = generateId();
                medications.push({ 
                    id: newId, 
                    name,
                    patientId, 
                    doctorId,
                    patientName: patient.name,
                    doctorName: doctor.name,
                    dosage, 
                    frequency,
                    startDate,
                    endDate,
                    createdAt: new Date().toISOString()
                });
            }
            
            localStorage.setItem('medications', JSON.stringify(medications));
            hideMedicationForm();
            loadMedications();
        }

        function loadMedications() {
            const medications = JSON.parse(localStorage.getItem('medications')) || [];
            const searchTerm = document.getElementById('medication-search').value.toLowerCase();
            
            // Filter medications if search term exists
            let filteredMedications = medications;
            if (searchTerm) {
                filteredMedications = medications.filter(medication => 
                    medication.name.toLowerCase().includes(searchTerm) ||
                    medication.patientName.toLowerCase().includes(searchTerm) ||
                    medication.doctorName.toLowerCase().includes(searchTerm) ||
                    medication.dosage.toLowerCase().includes(searchTerm)
                );
            }
            
            // Sort by start date (newest first)
            filteredMedications.sort((a, b) => new Date(b.startDate) - new Date(a.startDate));
            
            // Pagination
            const startIndex = (currentMedicationPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedMedications = filteredMedications.slice(startIndex, endIndex);
            
            const tbody = document.getElementById('medications-table');
            tbody.innerHTML = '';
            
            if (paginatedMedications.length === 0) {
                const tr = document.createElement('tr');
                tr.innerHTML = `<td colspan="6" class="px-6 py-4 text-center text-gray-500">No medications found</td>`;
                tbody.appendChild(tr);
            } else {
                paginatedMedications.forEach(medication => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap">${medication.id.substring(0, 8)}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${medication.name}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${medication.patientName}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${medication.doctorName}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${medication.dosage} (${medication.frequency})</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button onclick="editMedication('${medication.id}')" class="text-blue-600 hover:text-blue-800 mr-2">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="showModal('Delete Medication', 'Are you sure you want to delete this medication?', 'delete', { type: 'medication', id: '${medication.id}' })" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            }
            
            // Update pagination info
            document.getElementById('medication-start').textContent = filteredMedications.length > 0 ? startIndex + 1 : 0;
            document.getElementById('medication-end').textContent = Math.min(endIndex, filteredMedications.length);
            document.getElementById('medication-total').textContent = filteredMedications.length;
            
            // Update pagination buttons
            document.getElementById('medication-prev').disabled = currentMedicationPage === 1;
            document.getElementById('medication-next').disabled = endIndex >= filteredMedications.length;
        }

        function editMedication(id) {
            const medications = JSON.parse(localStorage.getItem('medications')) || [];
            const medication = medications.find(m => m.id === id);
            
            if (medication) {
                document.getElementById('medication-id').value = medication.id;
                document.getElementById('medication-name').value = medication.name;
                document.getElementById('medication-patient').value = medication.patientId;
                document.getElementById('medication-doctor').value = medication.doctorId;
                document.getElementById('medication-dosage').value = medication.dosage;
                document.getElementById('medication-frequency').value = medication.frequency;
                document.getElementById('medication-start-date').value = medication.startDate;
                document.getElementById('medication-end-date').value = medication.endDate;
                
                document.getElementById('medication-form-title').textContent = 'Edit Medication';
                document.getElementById('medication-form-container').classList.remove('hidden');
            }
        }

        function deleteMedication(id) {
            let medications = JSON.parse(localStorage.getItem('medications')) || [];
            medications = medications.filter(m => m.id !== id);
            localStorage.setItem('medications', JSON.stringify(medications));
            
            loadMedications();
        }

        function filterMedications(searchTerm) {
            currentMedicationPage = 1;
            loadMedications();
        }

        function prevMedicationPage() {
            if (currentMedicationPage > 1) {
                currentMedicationPage--;
                loadMedications();
            }
        }

        function nextMedicationPage() {
            const medications = JSON.parse(localStorage.getItem('medications')) || [];
            const searchTerm = document.getElementById('medication-search').value.toLowerCase();
            let filteredMedications = medications;
            
            if (searchTerm) {
                filteredMedications = medications.filter(medication => 
                    medication.name.toLowerCase().includes(searchTerm) ||
                    medication.patientName.toLowerCase().includes(searchTerm) ||
                    medication.doctorName.toLowerCase().includes(searchTerm) ||
                    medication.dosage.toLowerCase().includes(searchTerm)
                );
            }
            
            if (currentMedicationPage * itemsPerPage < filteredMedications.length) {
                currentMedicationPage++;
                loadMedications();
            }
        }

        function refreshMedications() {
            document.getElementById('medication-search').value = '';
            currentMedicationPage = 1;
            loadMedications();
        }

        // ==================== BILLING FUNCTIONS ====================
        function showBillingForm() {
            document.getElementById('billing-form-container').classList.remove('hidden');
            document.getElementById('billing-form-title').textContent = 'Add New Bill';
            document.getElementById('billing-form').reset();
            document.getElementById('billing-id').value = '';
            
            // Set default date to today
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('billing-date').value = today;
        }

        function hideBillingForm() {
            document.getElementById('billing-form-container').classList.add('hidden');
        }

        function saveBilling() {
            const id = document.getElementById('billing-id').value;
            const patientId = document.getElementById('billing-patient').value;
            const date = document.getElementById('billing-date').value;
            const amount = document.getElementById('billing-amount').value;
            const status = document.getElementById('billing-status').value;
            const description = document.getElementById('billing-description').value;
            
            const billing = JSON.parse(localStorage.getItem('billing')) || [];
            const patients = JSON.parse(localStorage.getItem('patients')) || [];
            
            const patient = patients.find(p => p.id === patientId);
            
            if (!patient) {
                alert('Invalid patient selected');
                return;
            }
            
            if (id) {
                // Update existing bill
                const index = billing.findIndex(b => b.id === id);
                if (index !== -1) {
                    billing[index] = { 
                        id, 
                        patientId, 
                        patientName: patient.name,
                        date, 
                        amount,
                        status,
                        description
                    };
                }
            } else {
                // Add new bill
                const newId = generateId();
                billing.push({ 
                    id: newId, 
                    patientId, 
                    patientName: patient.name,
                    date, 
                    amount,
                    status,
                    description,
                    createdAt: new Date().toISOString()
                });
            }
            
            localStorage.setItem('billing', JSON.stringify(billing));
            hideBillingForm();
            loadBilling();
        }

        function loadBilling() {
            const billing = JSON.parse(localStorage.getItem('billing')) || [];
            const searchTerm = document.getElementById('billing-search').value.toLowerCase();
            
            // Filter billing if search term exists
            let filteredBilling = billing;
            if (searchTerm) {
                filteredBilling = billing.filter(bill => 
                    bill.patientName.toLowerCase().includes(searchTerm) ||
                    bill.date.toLowerCase().includes(searchTerm) ||
                    bill.status.toLowerCase().includes(searchTerm) ||
                    bill.description.toLowerCase().includes(searchTerm)
                );
            }
            
            // Sort by date (newest first)
            filteredBilling.sort((a, b) => new Date(b.date) - new Date(a.date));
            
            // Pagination
            const startIndex = (currentBillingPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedBilling = filteredBilling.slice(startIndex, endIndex);
            
            const tbody = document.getElementById('billing-table');
            tbody.innerHTML = '';
            
            if (paginatedBilling.length === 0) {
                const tr = document.createElement('tr');
                tr.innerHTML = `<td colspan="6" class="px-6 py-4 text-center text-gray-500">No bills found</td>`;
                tbody.appendChild(tr);
            } else {
                paginatedBilling.forEach(bill => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap">${bill.id.substring(0, 8)}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${bill.patientName}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${formatDate(bill.date)}</td>
                        <td class="px-6 py-4 whitespace-nowrap">$${bill.amount}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 rounded-full text-xs ${getStatusClass(bill.status)}">
                                ${bill.status}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button onclick="editBilling('${bill.id}')" class="text-blue-600 hover:text-blue-800 mr-2">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="showModal('Delete Bill', 'Are you sure you want to delete this bill?', 'delete', { type: 'billing', id: '${bill.id}' })" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            }
            
            // Update pagination info
            document.getElementById('billing-start').textContent = filteredBilling.length > 0 ? startIndex + 1 : 0;
            document.getElementById('billing-end').textContent = Math.min(endIndex, filteredBilling.length);
            document.getElementById('billing-total').textContent = filteredBilling.length;
            
            // Update pagination buttons
            document.getElementById('billing-prev').disabled = currentBillingPage === 1;
            document.getElementById('billing-next').disabled = endIndex >= filteredBilling.length;
        }

        function editBilling(id) {
            const billing = JSON.parse(localStorage.getItem('billing')) || [];
            const bill = billing.find(b => b.id === id);
            
            if (bill) {
                document.getElementById('billing-id').value = bill.id;
                document.getElementById('billing-patient').value = bill.patientId;
                document.getElementById('billing-date').value = bill.date;
                document.getElementById('billing-amount').value = bill.amount;
                document.getElementById('billing-status').value = bill.status;
                document.getElementById('billing-description').value = bill.description;
                
                document.getElementById('billing-form-title').textContent = 'Edit Bill';
                document.getElementById('billing-form-container').classList.remove('hidden');
            }
        }

        function deleteBilling(id) {
            let billing = JSON.parse(localStorage.getItem('billing')) || [];
            billing = billing.filter(b => b.id !== id);
            localStorage.setItem('billing', JSON.stringify(billing));
            
            loadBilling();
        }

        function filterBilling(searchTerm) {
            currentBillingPage = 1;
            loadBilling();
        }

        function prevBillingPage() {
            if (currentBillingPage > 1) {
                currentBillingPage--;
                loadBilling();
            }
        }

        function nextBillingPage() {
            const billing = JSON.parse(localStorage.getItem('billing')) || [];
            const searchTerm = document.getElementById('billing-search').value.toLowerCase();
            let filteredBilling = billing;
            
            if (searchTerm) {
                filteredBilling = billing.filter(bill => 
                    bill.patientName.toLowerCase().includes(searchTerm) ||
                    bill.date.toLowerCase().includes(searchTerm) ||
                    bill.status.toLowerCase().includes(searchTerm) ||
                    bill.description.toLowerCase().includes(searchTerm)
                );
            }
            
            if (currentBillingPage * itemsPerPage < filteredBilling.length) {
                currentBillingPage++;
                loadBilling();
            }
        }

        function refreshBilling() {
            document.getElementById('billing-search').value = '';
            currentBillingPage = 1;
            loadBilling();
        }

        // ==================== UTILITY FUNCTIONS ====================
        function generateId() {
            return Date.now().toString(36) + Math.random().toString(36).substr(2);
        }

        function populatePatientDoctorDropdowns(type = 'appointment') {
            const patients = JSON.parse(localStorage.getItem('patients')) || [];
            const doctors = JSON.parse(localStorage.getItem('doctors')) || [];
            
            let patientDropdown, doctorDropdown;
            
            if (type === 'appointment') {
                patientDropdown = document.getElementById('appointment-patient');
                doctorDropdown = document.getElementById('appointment-doctor');
            } else if (type === 'treatment') {
                patientDropdown = document.getElementById('treatment-patient');
                doctorDropdown = document.getElementById('treatment-doctor');
            } else if (type === 'medication') {
                patientDropdown = document.getElementById('medication-patient');
                doctorDropdown = document.getElementById('medication-doctor');
            }
            
            // Clear existing options except the first one
            if (patientDropdown) {
                while (patientDropdown.options.length > 1) {
                    patientDropdown.remove(1);
                }
                
                patients.forEach(patient => {
                    const option = document.createElement('option');
                    option.value = patient.id;
                    option.textContent = patient.name;
                    patientDropdown.appendChild(option);
                });
            }
            
            if (doctorDropdown) {
                while (doctorDropdown.options.length > 1) {
                    doctorDropdown.remove(1);
                }
                
                doctors.forEach(doctor => {
                    const option = document.createElement('option');
                    option.value = doctor.id;
                    option.textContent = `${doctor.name} (${doctor.specialization})`;
                    doctorDropdown.appendChild(option);
                });
            }
        }

        function populatePatientDropdown(type = 'billing') {
            const patients = JSON.parse(localStorage.getItem('patients')) || [];
            let patientDropdown;
            
            if (type === 'billing') {
                patientDropdown = document.getElementById('billing-patient');
            }
            
            // Clear existing options except the first one
            if (patientDropdown) {
                while (patientDropdown.options.length > 1) {
                    patientDropdown.remove(1);
                }
                
                patients.forEach(patient => {
                    const option = document.createElement('option');
                    option.value = patient.id;
                    option.textContent = patient.name;
                    patientDropdown.appendChild(option);
                });
            }
        }
    </script>
</body>
</html>
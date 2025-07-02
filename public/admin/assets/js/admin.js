// Mobile sidebar toggle
  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('-translate-x-full');
  }
  // Dropdown toggle
  function toggleDropdown(id) {
    document.getElementById(id).classList.toggle('hidden');
  }


// table checkboxes with pagination
function toggleAllCheckboxes(source) {
  const checkboxes = document.querySelectorAll('.rowCheckbox');
  checkboxes.forEach(cb => cb.checked = source.checked);
}

function filterTableAndResetPagination() {
  currentPage = 1;
  renderTable();
}

let currentPage = 1;
const rowsPerPage = 5;

function renderTable() {
  const tbody = document.getElementById("tableBody");
  const filter = document.getElementById("tableSearch").value.toLowerCase();
  const rows = Array.from(tbody.getElementsByTagName("tr"));

  let filteredRows = [];
  rows.forEach(row => {
    const match = row.textContent.toLowerCase().includes(filter);
    row.style.display = "none";
    if (match) filteredRows.push(row);
  });

  const start = (currentPage - 1) * rowsPerPage;
  const end = start + rowsPerPage;
  filteredRows.forEach((row, index) => {
    if (index >= start && index < end) {
      row.style.display = "";
    }
  });

  document.getElementById("pageStart").textContent = filteredRows.length === 0 ? 0 : start + 1;
  document.getElementById("pageEnd").textContent = Math.min(end, filteredRows.length);
  document.getElementById("totalRows").textContent = filteredRows.length;
}

function changePage(direction) {
  const tbody = document.getElementById("tableBody");
  const filter = document.getElementById("tableSearch").value.toLowerCase();
  const rows = Array.from(tbody.getElementsByTagName("tr"));
  const filteredRows = rows.filter(row => row.textContent.toLowerCase().includes(filter));
  const totalPages = Math.ceil(filteredRows.length / rowsPerPage);

  currentPage += direction;
  if (currentPage < 1) currentPage = 1;
  if (currentPage > totalPages) currentPage = totalPages;
  renderTable();
}

window.addEventListener('load', renderTable);



// dropdown button scripts start
function toggleActionDropdown() {
    document.getElementById('actionDropdown').classList.toggle('hidden');
  }

  // Optional: Hide dropdown when clicking outside
  window.addEventListener('click', function(e) {
    const dropdown = document.getElementById('actionDropdown');
    if (!e.target.closest('#actionDropdown') && !e.target.closest('[onclick=\"toggleActionDropdown()\"]')) {
      dropdown.classList.add('hidden');
    }
  });


// preview image code 
function readURL(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function (e) {
      document.getElementById('previewimg').src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
  }
}

// preview for image upload 2
    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
              document.getElementById('previewimg1').src = e.target.result;
            };


            reader.readAsDataURL(input.files[0]);
        }
    }
    // preview for image upload 3
    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
              document.getElementById('previewimg2').src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

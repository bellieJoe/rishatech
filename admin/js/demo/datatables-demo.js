// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    "order": [[0, "desc"]]  // Sort by the first column (index 0) in descending order
  });

  $('#dataTables_Category').DataTable({
    "order": [[0, "desc"]]  // Sort by the first column (index 0) in descending order
  });

  $('#dataTables_salesHistory').DataTable({
    "order": [[0, "desc"]]  // Sort by the first column (index 0) in descending order
  });
});
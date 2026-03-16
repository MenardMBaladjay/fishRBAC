function effect(){
    document.getElementById('blur').style.display = "flex";
    document.getElementById('popup').style.display = "flex";

}
function closee(){
    document.getElementById('blur').style.display = "none";
    document.getElementById('popup').style.display = "none";

}
function cute(id) {
    if (confirm("Are you sure you want to delete this item?")) {
        window.location.href = `delete_data.php?id=${id}`;
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const exportButton = document.getElementById("exportPDF");
    if (!exportButton) return;
    const pageTitle = document.title.toLowerCase();
    if (pageTitle.includes("dashboard")) {
        exportButton.textContent = "Export Data";
        exportButton.addEventListener("click", function () {
            const table = document.querySelector("table");
            if (!table) {
                alert("No table found!");
                return;
            }
            const workbook = XLSX.utils.table_to_book(table, { sheet: "Sheet1" });
            XLSX.writeFile(workbook, "DashboardData.xlsx");
        });
    }
});

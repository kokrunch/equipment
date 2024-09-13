function writeTable(id) {
  $(id).DataTable({
    oLanguage: {
      sLengthMenu: "แสดง _MENU_ ต่อหน้า",
      sZeroRecords: "ไม่มีข้อมูล",
      sInfo: "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
      sInfoEmpty: "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
      sInfoFiltered: "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
      sSearch: "ค้นหา :",
      aaSorting: [[0, "desc"]],
      oPaginate: {
        sFirst: "หน้าแรก",
        sPrevious: "ก่อนหน้า",
        sNext: "ถัดไป",
        sLast: "หน้าสุดท้าย",
      },
    },
  });
}

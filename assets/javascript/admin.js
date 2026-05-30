
      const content = document.querySelectorAll(".dropdown-btn");

      content.forEach(dropdown_btn => {
            dropdown_btn.addEventListener("click", (() => {
                  let dropdown = dropdown_btn.closest(".content")?.querySelector(".content-dropdown");
                  if (dropdown) {
                        dropdown.classList.toggle("content-dropdown-js")
                        dropdown_btn.classList.toggle("sidebar-column1-i-p-i-i-js");
                  }
            }))
      });


      // Category ---- Create ---- Start 
      function cancel(){
            window.location.reload();
      }
      // Category ---- Create ---- End 


      // Order ---- Page ---- Start
      const status_dropdown = document.querySelectorAll("#status-dropdown");

      status_dropdown.forEach(dropdowns => {
            const element = dropdowns.closest(".columns")?.querySelector("#text");
            if (element) {
                  const text = element.innerHTML.trim();
                  if(text == "shipped"){
                        element.classList.add("shipped");
                  }
                  else if(text == "complete"){
                        element.classList.add("complete");
                  }
            }
      });
      // Order ---- Page ---- End


      
      const menuToggle = document.getElementById("menu-toggle");
      const sidebarContent = document.querySelector(".sidebar-content");
      const sidebar = document.querySelector(".sidebar");
      const overlay = document.getElementById("sidebar-overlay");

      function toggleSidebar() {
          if (window.innerWidth > 1200) {
              if (sidebarContent) {
                  sidebarContent.classList.toggle("sidebar-mini");
              }
          } else {
              if (sidebar) {
                  sidebar.classList.toggle("sidebar-active");
              }
              if (overlay) {
                  overlay.classList.toggle("active");
              }
          }
      }

      if(menuToggle) {
            menuToggle.addEventListener("click", toggleSidebar);
      }

      if(overlay) {
            overlay.addEventListener("click", toggleSidebar);
      }



      // Dashboard --- Page --- Start
      const d_status = document.querySelectorAll("#d-status");

      d_status.forEach(s => {
        const element = s.closest("tr").querySelector("#d-text");
           text = element.innerHTML;
        if(text == "shipped"){
            element.classList.add("shipped");
        }
        else if(text == "complete"){
            element.classList.add("complete");
        }

      })
      

      var options = {
    colors: ['#22c55e'],
    series: [{
      name: "Sales",
      data: [31, 40, 28, 51, 42, 109, 100]  // 👈 apne numbers
    }],
    chart: {
      type: 'area',
      height: 180,
      zoom: { enabled: false }
    },
    dataLabels: { enabled: false },
    stroke: { curve: 'straight' },
//     title: {
//       text: 'Orders Report',
//       align: 'left'
//     },
    xaxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul']  // 👈 apne labels
    },
    legend: { horizontalAlign: 'left' }
  };

  var chart = new ApexCharts(document.querySelector(".myChart"), options);
  chart.render();

    var options = {
    colors: ['#ff5200'],
    series: [{
      name: "Sales",
      data: [10, 20, 18, 91, 22, 19, 100]  // 👈 apne numbers
    }],
    chart: {
      type: 'area',
      height: 180,
      zoom: { enabled: false }
    },
    dataLabels: { enabled: false },
    stroke: { curve: 'straight' },
//     title: {
//       text: 'Orders Report',
//       align: 'left'
//     },
    xaxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul']  // 👈 apne labels
    },
    legend: { horizontalAlign: 'left' }
  };

  var chart = new ApexCharts(document.querySelector(".myChart2"), options);
  chart.render();

   var options = {
    colors: ['#a07936'],
    series: [{
      name: "Sales",
      data: [10, 20, 18, 30, 22, 19, 100]  // 👈 apne numbers
    }],
    chart: {
      type: 'area',
      height: 180,
      zoom: { enabled: false }
    },
    dataLabels: { enabled: false },
    stroke: { curve: 'straight' },
//     title: {
//       text: 'Orders Report',
//       align: 'left'
//     },
    xaxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul']  // 👈 apne labels
    },
    legend: { horizontalAlign: 'left' }
  };

  var chart = new ApexCharts(document.querySelector(".myChart3"), options);
  chart.render();


  var options = {
    colors: ['#0ea5e9'],
    series: [{
      name: "Sales",
      data: [30, 20, 18, 30, 22, 19, 100]  // 👈 apne numbers
    }],
    chart: {
      type: 'area',
      height: 180,
      zoom: { enabled: false }
    },
    dataLabels: { enabled: false },
    stroke: { curve: 'straight' },
//     title: {
//       text: 'Orders Report',
//       align: 'left'
//     },
    xaxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul']  // 👈 apne labels
    },
    legend: { horizontalAlign: 'left' }
  };

  var chart = new ApexCharts(document.querySelector(".myChart4"), options);
  chart.render();
  
      
      
            
      
      // Dashboard --- Page --- End
      

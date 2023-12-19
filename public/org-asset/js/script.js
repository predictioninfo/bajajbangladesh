$.ajax({
  url: '/org-chart',
  type: 'GET',
  dataType: 'json',
  success: function (response) {

    var empIdToNodeId = {};
    response.forEach(function(node) {
      empIdToNodeId[node.employee] = node.id;
    });
    
    var links = [];
    response.forEach(function(node) {
      if (node.supervisor) {
        links.push({
          from: empIdToNodeId[node.employee],
          to: empIdToNodeId[node.supervisor],
          template: 'yellow', label: 'Supervisor'
        });
      }
    });
    // console.log(links);

    OrgChart.templates.olivia.plus = '<circle cx="15" cy="15" r="15" fill="#ffffff" stroke="#aeaeae" stroke-width="1"></circle>'
+ '<text text-anchor="middle" style="font-size: 18px;cursor:pointer;" fill="#757575" x="15" y="22">{children-total-count}</text>';
    OrgChart.templates.olivia.minus = '<circle cx="15" cy="15" r="15" fill="#ffffff" stroke="#aeaeae" stroke-width="1"></circle>'
+ '<text text-anchor="middle" style="font-size: 18px;cursor:pointer;" fill="#757575" x="15" y="22">{children-total-count}</text>';

    var chart = new OrgChart(document.getElementById("tree"), {
      template: "olivia",
      mode: 'dark',
      layout: OrgChart.mixed,
      // mouseScrool: OrgChart.none,
      editForm: {
        generateElementsFromFields: false,
        elements: [
            { type: 'textbox', label: 'Full Name', binding: 'fullName' },
            { type: 'textbox', label: 'Department', binding: 'departmentName' },
            { type: 'textbox', label: 'Designation Name', binding: 'designationName' },
            { type: 'textbox', label: 'supervisor Name', binding: 'supervisorName' },
        ]
    },
      collapse: {
        // level: 5,
        allChildren: true
    },
      menu: {
        pdfPreview: {
          text: "PDF Preview",
          icon: OrgChart.icon.pdf(24, 24, '#7A7A7A'),
          onClick: preview
        },
        pdf: { text: "Export PDF" },
        png: { text: "Export PNG" },
        svg: { text: "Export SVG" },
        csv: { text: "Export CSV" }
      },
      slinks: links,
      nodeBinding: {
        field_0: "fullName",
        field_1: "departmentName",
        field_2: "designationName",
        field_3: "supervisorName",
        img_0: "img",
      },
    });

    chart.on('init', function () {
      preview();
    })
    function preview() {
      OrgChart.pdfPrevUI.show(chart, {
        format: 'A4'
      });
    }
    chart.load(response);
  },
  error: function (xhr, status, error) {
    console.log(error);
  }
});



// $.ajax({
//   url: '/org-chart',
//   type: 'GET',
//   dataType: 'json',
//   success: function (response) {
   
//     OrgChart.templates.olivia.plus = '<circle cx="15" cy="15" r="15" fill="#ffffff" stroke="#aeaeae" stroke-width="1"></circle>'
//     + '<text text-anchor="middle" style="font-size: 18px;cursor:pointer;" fill="#757575" x="15" y="22">{children-total-count}</text>';
//     OrgChart.templates.olivia.minus = '<circle cx="15" cy="15" r="15" fill="#ffffff" stroke="#aeaeae" stroke-width="1"></circle>'
//     + '<text text-anchor="middle" style="font-size: 18px;cursor:pointer;" fill="#757575" x="15" y="22">{children-total-count}</text>';

//     var chart = new OrgChart(document.getElementById("tree"), {
//       template: "olivia",
//       mode: 'dark',
//       layout: OrgChart.mixed,
//       // mouseScrool: OrgChart.none,
//       editForm: {
//         generateElementsFromFields: false,
//         elements: [
//             { type: 'textbox', label: 'Full Name', binding: 'fullName' },
//             { type: 'textbox', label: 'Department', binding: 'departmentName' },
//             { type: 'textbox', label: 'Designation Name', binding: 'designationName' },
//             { type: 'textbox', label: 'Employee Name', binding: 'employee' },
//             { type: 'textbox', label: 'supervisor Name', binding: 'supervisor' },
//         ]
//       },
//       collapse: {
//         level: 2,
//         allChildren: true
//       },
//       menu: {
//         pdfPreview: {
//           text: "PDF Preview",
//           icon: OrgChart.icon.pdf(24, 24, '#7A7A7A'),
//           onClick: preview
//         },
//         pdf: { text: "Export PDF" },
//         png: { text: "Export PNG" },
//         svg: { text: "Export SVG" },
//         csv: { text: "Export CSV" }
//       },
//       nodeBinding: {
//         field_0: "fullName",
//         field_1: "departmentName",
//         field_2: "designationName",
//         field_3: "employee",
//         field_3: "supervisor",
//         img_0: "img",
//       },
//       slinks: generateLinks(response) // set initial links based on response data
//     });

//     function generateLinks(nodes) {
//       var links = [];

//       // loop through nodes and add links based on supervisorId property
//       for (var i = 0; i < nodes.length; i++) {
//         var node = nodes[i];
//         if (node.supervisor) {
//           var link = { from: node.employee, to: node.supervisor };
//           links.push(link);
//         }
//       }

//       return links;
//     }

//     chart.on('init', function () {
//       preview();
//     });

//     function preview() {
//       OrgChart.pdfPrevUI.show(chart, {
//         format: 'A4'
//       });
//     }

//     chart.load(response);

//     // update links whenever the data changes
//     function updateLinks() {
//       var nodes = chart.getData();
//       var links = generateLinks(nodes);
//       chart.config.slinks = links;
//       chart.draw();
//     }

//     // example of updating links when user clicks a button
//     $('#update-links-btn').on('click', function() {
//       updateLinks();
//     });
//   },
//   error: function (xhr, status, error) {
//     console.log(error);
//   }
// });
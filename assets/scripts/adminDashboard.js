am5.ready(function() {

  let pending = 0
  let delivery = 0
  let completed = 0
  let declined = 0

  $.ajax ({
    url: window.location.origin + '/drms/admin/statusMonth',
    type: 'GET',
    success: function(data) {
      request = JSON.parse(data)

      $('#monthlyOverallStatus').text(request.title)

      pending = request.pending
      delivery = request.delivery
      completed = request.completed
      declined = request.declined

    },
    error: function(xhr, status, error) {
      console.log(xhr)
      console.log(status)
      console.log(error)
    },
    'async': false,
    'global': false,
  })





  let cog = 0;
  let coe = 0;
  let cue = 0;
  let ccd = 0;
  let cgr = 0;
  let cgah = 0;
  let cgg = 0;
  let cgs = 0;
  let cft = 0;
  let cnid = 0;
  let cr = 0;
  let checklist = 0;
  let tor = 0;
  let honor = 0;
  let diploma = 0;
  let authentication = 0;
  let CAV = 0;
  let CAVD = 0;
  let endorse = 0;
  let others = 0;


  $.ajax ({
    url: window.location.origin + '/drms/admin/statusMostRequested',
    type: 'GET',
    success: function(data) {
      request = JSON.parse(data)

      console.log(request)
      console.log(JSON.stringify(request))


      $('#monthlyMostRequested').text(request.title)

      cog = request.cog;
      coe = request.coe;
      cue = request.cue;
      ccd = request.ccd;
      cgr = request.cgr;
      cgah = request.cgah;
      cgg = request.cgg;
      cgs = request.cgs;
      cft = request.cft;
      cnid = request.cnid;
      cr = request.cr;
      checklist = request.checklist;
      tor = request.tor;
      honor = request.honor;
      diploma = request.diploma;
      authentication = request.authentication;
      CAV = request.CAV;
      CAVD = request.CAVD;
      endorse = request.endorse;
      others = request.others;


    },
    error: function(xhr, status, error) {
      console.log(xhr)
      console.log(status)
      console.log(error)
    },
    'async': false,
    'global': false,
  })


  console.log(cog)
  console.log(coe)
  console.log(cue)
  console.log(ccd)
  console.log(cgr)
  console.log(cgah)
  console.log(cgg)
  console.log(cgs)
  console.log(cft)
  console.log(cnid)
  console.log(cr)
  console.log(checklist)
  console.log(tor)
  console.log(honor)
  console.log(diploma)
  console.log(authentication)
  console.log(CAV)
  console.log(CAVD)
  console.log(endorse)
  console.log(others)








  // Create root element
  // https://www.amcharts.com/docs/v5/getting-started/#Root_element
  var chartOverallStats = am5.Root.new("chartOverallStats");
  
  
  // Set themes
  // https://www.amcharts.com/docs/v5/concepts/themes/
  chartOverallStats.setThemes([
    am5themes_Animated.new(chartOverallStats)
  ]);
  
  
  // Create chart
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
  var chart = chartOverallStats.container.children.push(am5percent.PieChart.new(chartOverallStats, {
    layout: chartOverallStats.verticalLayout
  }));
  
  
  // Create series
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
  var series = chart.series.push(am5percent.PieSeries.new(chartOverallStats, {
    valueField: "count",
    categoryField: "request"
  }));
  

  // Set data
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
  // series.data.setAll = gfg;
  series.data.setAll([
    {
      "request":"Pending",
      "count":pending
    },
    {
      "request":"Delivery",
      "count":delivery}
    ,
    {
      "request":"Completed",
      "count":completed
    },
    {
      "request":"Declined",
      "count":declined
    }
  ]);
  

  // Create legend
  // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
  var legend = chart.children.push(am5.Legend.new(chartOverallStats, {
    centerX: am5.percent(50),
    x: am5.percent(50),
    marginTop: 15,
    marginBottom: 15,
  }));

  legend.data.setAll(series.dataItems);
  
  
  
  // Play initial series animation
  // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
  series.appear(1000, 100);














  // Create root element
  // https://www.amcharts.com/docs/v5/getting-started/#Root_element
  var chartMostRequestDocs = am5.Root.new("chartMostRequestDocs");
  
  
  // Set themes
  // https://www.amcharts.com/docs/v5/concepts/themes/
  chartMostRequestDocs.setThemes([
    am5themes_Animated.new(chartMostRequestDocs)
  ]);
  
  
  // Create chart
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
  var chart = chartMostRequestDocs.container.children.push(am5percent.PieChart.new(chartMostRequestDocs, {
    layout: chartMostRequestDocs.verticalLayout
  }));
  
  
  // Create series
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
  var series = chart.series.push(am5percent.PieSeries.new(chartMostRequestDocs, {
    valueField: "count",
    categoryField: "document"
  }));
  
  
  // Set data
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
  series.data.setAll([
    {
      "document":"Certification of Grades",
      "count":cog
    },
    {
      "document":"Certification of Enrollment",
      "count":coe
    },
    {
      "document":"Certification of Units Earned",
      "count":cue
    },
    {
      "document":"Certification of Course Description",
      "count":ccd
    },
    {
      "document":"Certification of Graduating with Ranking",
      "count":cgr
    },
    {
      "document":"Certification of Graduating with Academic Honors",
      "count":cgah
    },
    {
      "document":"Certification of Graduation with GWA",
      "count":cgg
    },
    {
      "document":"Certification of Free Tuition",
      "count":cgs
    },
    {
      "document":"Certification of No Issued ID",
      "count":cft
    },
    {
      "document":"Certification of Registration",
      "count":cnid
    },
    {
      "document":"Checklist of Completed Grades",
      "count":cr
    },
    {
      "document":"Transcript of Records",
      "count":checklist
    },
    {
      "document":"Honorable Dismissal & Transfer Credentials",
      "count":tor
    },
    {
      "document":"Copy of Diploma",
      "count":honor
    },
    {
      "document":"Authentication",
      "count":authentication
    },
    {
      "document":"CAV (for DFA)",
      "count":CAV
    },
    {
      "document":"CAV (for non-DFA)",
      "count":endorse
    },
    {
      "document":"Endorsement Letter",
      "count":CAVD
    },
    {
      "document":"Others",
      "count":others
    },
  ]);


  // Create legend
  // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
  var legend = chart.children.push(am5.Legend.new(chartMostRequestDocs, {
    centerX: am5.percent(50),
    x: am5.percent(50),
    marginTop: 15,
    marginBottom: 15,
  }));

  legend.data.setAll(series.dataItems);
  
  
  // Play initial series animation
  // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
  series.appear(1000, 100);






  
}); // end am5.ready()
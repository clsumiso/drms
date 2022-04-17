am5.ready(function() {

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
    valueField: "value",
    categoryField: "category"
  }));
  
  
  // Set data
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
  series.data.setAll([
    { value: 10, category: "One" },
    { value: 9, category: "Two" },
    { value: 6, category: "Three" },
    { value: 5, category: "Four" },
    { value: 4, category: "Five" },
    { value: 3, category: "Six" },
    { value: 1, category: "Seven" },
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
    valueField: "value",
    categoryField: "category"
  }));
  
  
  // Set data
  // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
  series.data.setAll([
    { value: 10, category: "One" },
    { value: 9, category: "Two" },
    { value: 6, category: "Three" },
    { value: 5, category: "Four" },
    { value: 4, category: "Five" },
    { value: 3, category: "Six" },
    { value: 1, category: "Seven" },
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
am5.ready(function() {

    var requestStatus = am5.Root.new("requestStatus");

    // requestStatus.setThemes([
    //     am5themes_Animated.new(requestStatus)
    // ]);

    var chart = requestStatus.container.children.push(am5percent.PieChart.new(requestStatus, {
        layout: requestStatus.verticalLayout,
        innerRadius: am5.percent(35)
    }));
    
    var series = chart.series.push(am5percent.PieSeries.new(requestStatus, {
        valueField: "value",
        categoryField: "category"
    }));
    
    
    series.data.setAll([
        { value: 5512, category: "Completed" },
        { value: 522, category: "Declined" },
        { value: 222, category: "Delivery" },
        { value: 912, category: "Pending" },
    ]);
    
    var legend = chart.children.push(am5.Legend.new(requestStatus, {
        centerX: am5.percent(50),
        x: am5.percent(50),
        marginTop: 1,
        marginBottom: 25
    }));
    
    legend.data.setAll(series.dataItems);
    series.appear(0, 100);






    var mostRequested = am5.Root.new("mostRequested");

    // mostRequested.setThemes([
    //     am5themes_Animated.new(mostRequested)
    // ]);

    var chart = mostRequested.container.children.push(am5percent.PieChart.new(mostRequested, {
        layout: mostRequested.verticalLayout,
        innerRadius: am5.percent(35)
    }));
    
    var series = chart.series.push(am5percent.PieSeries.new(mostRequested, {
        valueField: "value",
        categoryField: "category"
    }));
    
    
    series.data.setAll([
        { value: 5512, category: "Certification" },
        { value: 522, category: "Checklist" },
        { value: 222, category: "TOR" },
        { value: 912, category: "Endorsement" },
        { value: 912, category: "Honorable Dismissal" },
        { value: 912, category: "Diploma" },
        { value: 912, category: "CAV" },
        { value: 912, category: "Authentication" },
        { value: 912, category: "Other" },
    ]);
    
    var legend = chart.children.push(am5.Legend.new(mostRequested, {
        centerX: am5.percent(50),
        x: am5.percent(50),
        marginTop: 1,
        marginBottom: 25
    }));
    
    legend.data.setAll(series.dataItems);
    
    series.appear(0, 100);










    var requestRecord = am5.Root.new("requestRecord");

    // requestRecord.setThemes([
    //   am5themes_Animated.new(requestRecord)
    // ]);
    
    
    var chart = requestRecord.container.children.push(am5xy.XYChart.new(requestRecord, {
      panX: true,
      panY: false,
      wheelX: "panX",
      wheelY: "zoomX",
      layout: requestRecord.verticalLayout
    }));
    
    
    var legend = chart.children.push(
      am5.Legend.new(requestRecord, {
        centerX: am5.p50,
        x: am5.p50
      })
    );
    
    var data = [{
        "month": "January",
        "total": 2561,
        "completed": 2521,
        "declined": 40,
        "pending": 0
    }, {
        "month": "February",
        "total": 2.5,
        "completed": 2.5,
        "declined": 2.1,
        "pending": 1 
    }, {
        "month": "March",
        "total": 2.5,
        "completed": 2.5,
        "declined": 2.1,
        "pending": 1 
    }, {
        "month": "April",
        "total": 2.5,
        "completed": 2.5,
        "declined": 2.1,
        "pending": 1 
    }, {
        "month": "May",
        "total": 2.5,
        "completed": 2.5,
        "declined": 2.1,
        "pending": 1 
    }, {
        "month": "June",
        "total": 2.5,
        "completed": 2.5,
        "declined": 2.1,
        "pending": 1 
    }, {
        "month": "July",
        "total": 2.5,
        "completed": 2.5,
        "declined": 2.1,
        "pending": 1 
    }, {
        "month": "August",
        "total": 2.5,
        "completed": 2.5,
        "declined": 2.1,
        "pending": 1 
    }, {
        "month": "September",
        "total": 2.5,
        "completed": 2.5,
        "declined": 2.1,
        "pending": 1 
    }, {
        "month": "October",
        "total": 2.5,
        "completed": 2.5,
        "declined": 2.1,
        "pending": 1 
    }, {
        "month": "November",
        "total": 2.5,
        "completed": 2.5,
        "declined": 2.1,
        "pending": 1 
    }, {
        "month": "December",
        "total": 2.5,
        "completed": 2.5,
        "declined": 2.1,
        "pending": 1 
    }]
    
    
    var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(requestRecord, {
      categoryField: "month",
      renderer: am5xy.AxisRendererX.new(requestRecord, {
        cellStartLocation: 0.1,
        cellEndLocation: 0.9
      }),
      tooltip: am5.Tooltip.new(requestRecord, {})
    }));
    
    xAxis.data.setAll(data);
    

    var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(requestRecord, {
      renderer: am5xy.AxisRendererY.new(requestRecord, {})
    }));
    

    function makeSeries(name, fieldName) {
      var series = chart.series.push(am5xy.ColumnSeries.new(requestRecord, {
        name: name,
        xAxis: xAxis,
        yAxis: yAxis,
        valueYField: fieldName,
        categoryXField: "month"
      }));
    
      series.columns.template.setAll({
        tooltipText: "{name}, {categoryX}:{valueY}",
        width: am5.percent(90),
        tooltipY: 0,
      });
    
      series.data.setAll(data);
    
      // Make stuff animate on load
      // https://www.amcharts.com/docs/v5/concepts/animations/
      series.appear();
    
      series.bullets.push(function () {
        return am5.Bullet.new(requestRecord, {
          locationY: 0,
          sprite: am5.Label.new(requestRecord, {
            text: "{valueY}",
            fill: requestRecord.interfaceColors.get("alternativeText"),
            centerY: 0,
            centerX: am5.p50,
            populateText: true
          })
        });
      });
    
      legend.data.push(series);
    }
    
    
    makeSeries("Total Requests", "total");
    makeSeries("Completed Requests", "completed");
    makeSeries("Declined Requests", "declined");
    makeSeries("Pending Requests", "pending");
    
    
    // Make stuff animate on load
    // https://www.amcharts.com/docs/v5/concepts/animations/
    series.appear(0, 100);
    




}); // end am5.ready()

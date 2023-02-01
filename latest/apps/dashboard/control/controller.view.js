

  // Data example
  monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
  data1 = [150, 110, 90, 115, 125, 160, 160, 140, 100, 110, 120, 120]
  data2 = [180, 140, 120, 135, 155, 170, 180, 150, 140, 150, 130, 130]
  data3 = [100, 90, 60, 70, 100, 75, 90, 85, 90, 100, 95, 88]

  // Chart options
  const options = {
    maintainAspectRatio: false, // disable the maintain aspect ratio in options then it uses the available height
    tooltips: {
      mode: 'index',
      intersect: false, // Interactions configuration: https://www.chartjs.org/docs/latest/general/interactions/
    },
    elements: {
      rectangle: {
        borderWidth: 1 // bar border width
      },
      line: {
        borderWidth: 1 // label border width
      }
    },
    legend: {
      display: false // hide label
    }
  }

  /***************** Website Audience Metrics *****************/
  new Chart('websiteAudienceMetrics', {
    type: 'bar',
    data: {
      labels: monthNames,
      datasets: [{
          backgroundColor: Chart.helpers.color(cyan).alpha(0.5).rgbString(),
          borderColor: cyan,
          data: data1
        },
        {
          backgroundColor: Chart.helpers.color(blue).alpha(0.5).rgbString(),
          borderColor: blue,
          data: data2
        }
      ]
    },
    options: options
  })

  /***************** Sessions By Channel *****************/
  new Chart('sessionsByChannel', {
    type: 'doughnut',
    data: {
      labels: ['Organic Search', 'Email', 'Referrral', 'Social Media'],
      datasets: [{
        data: [25, 20, 30, 25],
        backgroundColor: [
          Chart.helpers.color(red).alpha(0.5).rgbString(),
          Chart.helpers.color(blue).alpha(0.5).rgbString(),
          Chart.helpers.color(cyan).alpha(0.5).rgbString(),
          Chart.helpers.color(orange).alpha(0.5).rgbString(),
        ]
      }]
    },
    options: options
  })

  /***************** Device Sessions *****************/
  new Chart('deviceSessions', {
    type: 'line',
    data: {
      labels: monthNames,
      datasets: [{
          label: 'Mobile',
          backgroundColor: Chart.helpers.color(blue).alpha(0.1).rgbString(),
          borderColor: blue,
          tension: 0,
          pointRadius: 0,
          data: data2
        },
        {
          label: 'Desktop',
          backgroundColor: Chart.helpers.color(yellow).alpha(0.1).rgbString(),
          borderColor: yellow,
          tension: 0,
          pointRadius: 0,
          data: data1
        },
        {
          label: 'Other',
          backgroundColor: Chart.helpers.color(pink).alpha(0.1).rgbString(),
          borderColor: pink,
          tension: 0,
          pointRadius: 0,
          data: data3
        }
      ]
    },
    options: options
  })

  $(() => {
    /***************** Connections *****************/
    $('#connections').sparkline('html', {
      type: 'bar',
      barWidth: 8,
      height: 20,
      barColor: blue
    })

    /***************** Your Articles *****************/
    $('#yourArticles').sparkline('html', {
      type: 'bar',
      barWidth: 8,
      height: 20,
      barColor: red
    })

    /***************** Your Photos *****************/
    $('#yourPhotos').sparkline('html', {
      type: 'bar',
      barWidth: 8,
      height: 20,
      barColor: green
    })

    /***************** Your Photos *****************/
    $('#pageLikes').sparkline('html', {
      type: 'bar',
      barWidth: 8,
      height: 20,
      barColor: cyan
    })
  })



  new Chart('pie-basic', {
    type: 'pie',
    data: {
      labels: ['Red', 'Blue', 'Yellow'],
      datasets: [{
        data: [300, 50, 100],
        backgroundColor: [red, blue, yellow]
      }]
    },
    options: options
  })

  monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July']
  data1 = [33, 79, 85, 54, 64, 97, 79]


  new Chart('bar-chart-horizontal', {
    type: 'horizontalBar',
    data: {
      labels: monthNames,
      datasets: [{
        label: 'My dataset',
        backgroundColor: Chart.helpers.color(green).alpha(0.5).rgbString(),
        borderColor: green,
        data: data1
      }]
    },
    options: {
      maintainAspectRatio: false, 
      tooltips: {
        mode: 'index',
        intersect: false,
      },
      elements: {
        line: {
          borderWidth: 1
        },
        rectangle: {
          borderWidth: 1
        }
      }
    }
  })
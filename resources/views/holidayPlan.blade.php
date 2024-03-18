<!DOCTYPE html>
<html>
<head>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
      font-weight: bold;
    }
    
    .header {
      background-color: #333;
      color: white;
      padding: 10px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="header">
    <h2>Holiday Plans</h2>
  </div>
  <table>
    <thead>
      <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Date</th>
        <th>Participants</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{$holidayPlan->title}}</td>
        <td>{{$holidayPlan->description}}</td>
        <td>{{$holidayPlan->date}}</td>
        <td>{{$holidayPlan->participants}}</td>
      </tr>
    </tbody>
  </table>
</body>
</html>
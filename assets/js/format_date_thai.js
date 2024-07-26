const FormatToThaiDate = (date, time) => {
  const dateNew = new Date(date);
  let thaiDate = dateNew.toLocaleString("th-TH", {
    day: "2-digit",
    month: "2-digit",
    year: "numeric",
    timeZone: "UTC",
  });

  let returnTime;

  if (time != null) {
    returnTime =
      dateNew.getHours() +
      ":" +
      dateNew.getMinutes() +
      ":" +
      dateNew.getSeconds();

    thaiDate = thaiDate + " " + returnTime;
  }

  return thaiDate;
};

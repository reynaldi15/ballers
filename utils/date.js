export const formatReadableDate = (
  date,
  config = { short: false, withTime: false }
) => {
  const dayjs = useDayjs();

  const month = config?.short ? "MMM" : "MMMM";
  const time = config?.withTime ? ", HH:mm WIB" : "";
  const dateFormat = `DD ${month} YYYY${time}`;

  return dayjs(new Date(date)).format(dateFormat);
};

export const formatInputDate = (date) => {
  const dayjs = useDayjs();
  return dayjs(new Date(date)).format("YYYY-MM-DD");
}

export const formatCompactedNumber = (num) => Intl.NumberFormat('id-ID', {
  notation: 'compact',
  maximumFractionDigits: 0
}).format(num);

export const formatCurrency = (num) => Intl.NumberFormat('id-ID', {
  style: 'currency',
  currency: 'IDR',
  maximumFractionDigits: 0
}).format(num);

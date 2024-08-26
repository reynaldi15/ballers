export const convertFileToUrl = (file) => {
  let blob = file;
  if (!(blob instanceof Blob)) {
    blob = new Blob(file);
  }

  const res = URL.createObjectURL(blob);
  URL.revokeObjectURL(blob);

  return res;
};

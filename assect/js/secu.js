document.oncontextmenu = () => {
  return false;
};

document.onkeydown = (e) => {
  if (e.key == "F12") {
    return false;
  }

  if (e.ctrlKey && e.key == "u") {
    return false;
  }

  if (e.ctrlKey && e.key == "I") {
    return false;
  }
};

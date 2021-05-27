(async () => {
    const data = await handleFormOptions();
    outputCohorts(data.cohorts);
    if (document.getElementById('tasterDate')) {
        outputEvents(data.tasters, document.getElementById('tasterDate'));
    }
    outputHearAbout(data.hearAbout);
    if (document.querySelector('#chosenCourseId')) {
        outputCohorts(data.cohorts, document.querySelector('#chosenCourseId'));
    }
})()
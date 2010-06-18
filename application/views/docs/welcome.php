<h2>Welcome to the Claero Base Application.</h2>

<h3>Application layout</h3>

<p>The Claero Base Application is comprised of three main parts:</p>

<ul>
    <li>
        <h4>Common base "application", "public", and "data" folders</h4>
        <p>These folders contain common classes, images and other assets, and code.  These provide
        a framework for extending projects into more custom functionality.</p>
    </li>
    <li>
        <h4>External "system" folder</h4>
        <p>This folder is an external to a repository containing the latest version of the Kohana
        system.  When KO3 updates, we can add it to that repository and update this external, so
        that all new applications have the latest KO3.</p>
    </li>
    <li>
        <h4>Collection of external modules</h4>
        <p>
            The "modules" folder itself is not an external, but all the sub-folders are.  This
            allows us to:
            <ol>
                <li>Manually upgrade and test new versions of modules that we depend on.</li>
                <li>Develop and version a set of Claero Modules that - along with the base
                "application" and "public" folders - enables quick and powerful application
                creation.</li>
            </ol>
        </p>
    </li>
</ul>

<h3>MVC Split</h3>

<ul>
    <li>Thin controllers, fat models.</li>
    <li>Models don't have to be ORM-based - they are just an intelligent location and division
    of business logic.</li>
    <li>Models don't <i>have to have</i> any database code at all - reporting models could
    take in already-loaded data and spit back out "crunched" data for use in a report view.</li>
    <li>No code in views above the level of "required for display".  No database access, etc.</li>
</ul>

<h3>The place of ClaeroLib</h3>

<ul>
    <li>As modules developed separately.</li>
    <li>ClaeroEdit/ClaeroField either can be replicated through ORM, or as an ORM
    extension?  Not familiar enough with these to make the call.</li>
    <li>ClaeroDisplay particularly as a separate module.</li>
</ul>

<h3>Important ideas</h3>

<ul>
    <li>Loose coupling - so important!  No module should be developed specifically for a single
    project, it should be general cased, with specificities sub-classed in the application
    folder itself.<br />
    <br />
    Benefits:
    <ul>
        <li>When using it for another project, we have less to "un-do".</li>
        <li>When fixing a problem in one site, more likely we can port the fix directly across
        to other sides using the module without worrying about individual site customizations.</li>
        <li>Can release module to community, allowing for them to use it, refine it, and
        provide feedback and bug tests/fixes.</li>
    </ul></li>
</ul>
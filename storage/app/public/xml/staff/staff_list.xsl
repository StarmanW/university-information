<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : course_list.xsl
    Created on : July 16, 2019, 4:29 PM
    Author     : 
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>
    <xsl:template match="/">
        <xsl:for-each select="staffList/staff">
            <tr>
                <td>
                    <xsl:value-of select="name"></xsl:value-of>
                </td>
                <td>
                    <xsl:value-of select="position"></xsl:value-of>
                </td>
                <td>
                    <xsl:value-of select="faculty"></xsl:value-of>
                </td>
                <td>
                    <xsl:value-of select="specialization"></xsl:value-of>
                </td>
                <td>
                    <xsl:value-of select="area_of_interest"></xsl:value-of>
                </td>
            </tr>
        </xsl:for-each>
    </xsl:template>
</xsl:stylesheet>

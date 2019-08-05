<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : course_list.xsl
    Created on : July 16, 2019, 4:29 PM
    Author     : TARUC
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>
    <xsl:template match="/">
        <xsl:for-each select="courseList/course">
            <tr>
                <td>
                    <xsl:value-of select="id"></xsl:value-of>
                </td>
                <td>
                    <xsl:value-of select="course_name"></xsl:value-of>
                </td>
                <td>
                    <xsl:value-of select="course_cred_hour"></xsl:value-of>
                </td>
                <td>
                    <xsl:value-of select="format-number(course_fee, '#.00')"></xsl:value-of>
                </td>
                <td>
                    <xsl:element name="a">
                        <xsl:attribute name="href">
                            <xsl:text>/faculty_staff/courses/</xsl:text>
                            <xsl:value-of select="id"/>
                            <xsl:text>/edit</xsl:text>
                        </xsl:attribute>
                        <xsl:attribute name="class">
                            <xsl:text>btn btn-outline-primary btn-md btn-block</xsl:text>
                        </xsl:attribute>
                        <xsl:text>Edit</xsl:text>
                    </xsl:element>
                </td>
                <td>
                    <xsl:element name="a">
                        <xsl:attribute name="class">
                            <xsl:text>btn btn-outline-danger btn-md btn-block</xsl:text>
                        </xsl:attribute>
                        <xsl:attribute name="onclick">
                            <xsl:text>deleteCourse('</xsl:text>
                            <xsl:value-of select="id"/>
                            <xsl:text>', '</xsl:text>
                            <xsl:value-of select="course_name"/>
                            <xsl:text>')</xsl:text>
                        </xsl:attribute>
                        <xsl:text>Delete</xsl:text>
                    </xsl:element>
                </td>
            </tr>
        </xsl:for-each>
    </xsl:template>
</xsl:stylesheet>
